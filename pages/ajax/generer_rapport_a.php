<?php
/**
 * Script AJAX pour générer le A-Rapport DGI
 * Rapport détaillé par article/service avec quantités et montants
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../classes/connexion.php';
require_once __DIR__ . '/../../config/api_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
    exit;
}

$operation = $_POST['operation'] ?? null;

// ===================================================
// Operation: Récupérer le dernier A-Rapport généré
// ===================================================
if ($operation === 'get_dernier_rapport') {
    try {
        $query_dernier = $connexion->prepare("
            SELECT * FROM rapports_dgi
            WHERE type_rapport = 'A'
            ORDER BY date_generation DESC
            LIMIT 1
        ");
        $query_dernier->execute();
        $dernier = $query_dernier->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            'success' => true,
            'dernier_rapport' => $dernier
        ]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
    exit;
}

// ===================================================
// Operation: Générer A-Rapport
// ===================================================
$mode = $_POST['mode'] ?? 'auto';
$date_debut = $_POST['date_debut'] ?? null;
$date_fin = $_POST['date_fin'] ?? null;

if ($operation !== 'generer_rapport_a') {
    echo json_encode(['success' => false, 'error' => 'Opération invalide']);
    exit;
}

try {
    // ===================================================
    // 1. Déterminer la période selon le mode
    // ===================================================
    if ($mode === 'auto') {
        // Mode automatique : depuis le dernier A-Rapport
        $query_dernier = $connexion->prepare("
            SELECT periode_fin FROM rapports_dgi
            WHERE type_rapport = 'A'
            ORDER BY date_generation DESC
            LIMIT 1
        ");
        $query_dernier->execute();
        $dernier = $query_dernier->fetch(PDO::FETCH_ASSOC);

        if ($dernier) {
            // Commencer après le dernier rapport
            $date_debut = date('Y-m-d', strtotime($dernier['periode_fin'] . ' +1 day'));
        } else {
            // Premier A-Rapport : commencer au début du mois
            $date_debut = date('Y-m-01');
        }

        $date_fin = date('Y-m-d'); // Jusqu'à aujourd'hui

    } else {
        // Mode périodique : utiliser les dates fournies
        if (!$date_debut || !$date_fin) {
            throw new Exception('Dates de période manquantes');
        }
    }

    // ===================================================
    // 2. Récupérer toutes les factures de la période
    // IMPORTANT: UNION pour séparer FV et FA
    // ===================================================
    $query_factures = $connexion->prepare("
        -- Factures de Vente (FV)
        SELECT
            fd.ref_fact,
            fd.date_fact,
            fd.date_DGI,
            'FV' as type_facture,
            fd.code_UID as code_uid
        FROM facture_dossier fd
        WHERE DATE(fd.date_DGI) >= ?
            AND DATE(fd.date_DGI) <= ?
            AND fd.date_DGI IS NOT NULL
            AND fd.code_UID IS NOT NULL

        UNION ALL

        -- Factures d'Avoir (FA)
        SELECT
            fd.ref_fact,
            fd.date_fact,
            fd.date_DGI_FA as date_DGI,
            'FA' as type_facture,
            fd.code_UID_FA as code_uid
        FROM facture_dossier fd
        WHERE DATE(fd.date_DGI_FA) >= ?
            AND DATE(fd.date_DGI_FA) <= ?
            AND fd.date_DGI_FA IS NOT NULL
            AND fd.code_UID_FA IS NOT NULL

        ORDER BY date_DGI ASC
    ");
    $query_factures->execute([$date_debut, $date_fin, $date_debut, $date_fin]);
    $factures = $query_factures->fetchAll(PDO::FETCH_ASSOC);

    // ===================================================
    // 2. Regrouper par article/débours
    // ===================================================
    $articles_map = [];

    foreach ($factures as $facture) {
        $type_fact = $facture['type_facture'];

        // Récupérer les détails de la facture
        $query_details = $connexion->prepare("
            SELECT
                dfd.*,
                d.nom_deb,
                d.abr_deb,
                d.id_t_deb,
                dos.roe_decl
            FROM detail_facture_dossier dfd
            LEFT JOIN debours d ON dfd.id_deb = d.id_deb
            LEFT JOIN dossier dos ON dfd.id_dos = dos.id_dos
            WHERE dfd.ref_fact = ?
        ");
        $query_details->execute([$facture['ref_fact']]);
        $details = $query_details->fetchAll(PDO::FETCH_ASSOC);

        foreach ($details as $detail) {
            $id_deb = $detail['id_deb'];
            $code_article = $detail['abr_deb'] ?? 'SERV-' . $id_deb;
            $nom_article = $detail['nom_deb'] ?? 'Service';

            // Déterm iner le type d'article (SER = Service par défaut)
            $type_article = 'SER';
            if ($type_fact === 'FA') {
                $type_article = 'RAM'; // Avoir/Retour
            }

            // Calculer montant en USD
            $montant = floatval($detail['montant'] ?? 0);
            $montant_tva_detail = floatval($detail['montant_tva'] ?? 0);
            $roe = floatval($detail['roe_decl'] ?? 1);
            $tva = $detail['tva'] == '1';
            $usd = $detail['usd'] == '1';

            if (!$usd) {
                $montant = $montant / $roe;
                if ($montant_tva_detail > 0) {
                    $montant_tva_detail = $montant_tva_detail / $roe;
                }
            }

            // Calculer TVA
            if ($tva) {
                if ($montant_tva_detail > 0) {
                    $tva_calcule = $montant_tva_detail;
                } else {
                    $tva_calcule = $montant * 0.16;
                }
                $taux_tva = 16;
                $groupe_taxation = 'B';
            } else {
                $tva_calcule = 0;
                $taux_tva = 0;
                $groupe_taxation = 'A';
            }

            $montant_ttc = $montant + $tva_calcule;

            // Quantité (1 par défaut pour les services)
            $quantite = floatval($detail['quantite'] ?? 1);
            if ($quantite == 0) {
                $quantite = 1;
            }

            $prix_unitaire = $montant / $quantite;

            // Initialiser l'article s'il n'existe pas
            if (!isset($articles_map[$code_article])) {
                $articles_map[$code_article] = [
                    'code_article' => $code_article,
                    'nom_article' => $nom_article,
                    'type_article' => $type_article,
                    'prix_unitaire' => $prix_unitaire,
                    'taux_tva' => $taux_tva,
                    'groupe_taxation' => $groupe_taxation,
                    'quantite_vendue' => 0,
                    'quantite_retournee' => 0,
                    'montant_ventes' => 0,
                    'montant_retours' => 0
                ];
            }

            // Cumuler selon le type de facture
            if ($type_fact === 'FV') {
                // Facture de vente
                $articles_map[$code_article]['quantite_vendue'] += $quantite;
                $articles_map[$code_article]['montant_ventes'] += $montant_ttc;
            } else if ($type_fact === 'FA') {
                // Facture d'avoir (retour)
                $articles_map[$code_article]['quantite_retournee'] += $quantite;
                $articles_map[$code_article]['montant_retours'] += $montant_ttc;
                $articles_map[$code_article]['type_article'] = 'RAM';
            }
        }
    }

    // ===================================================
    // 3. Convertir en tableau et calculer statistiques
    // ===================================================
    $articles = array_values($articles_map);

    $stats = [
        'nbre_articles' => count($articles),
        'total_ventes' => 0,
        'total_retours' => 0,
        'montant_net' => 0
    ];

    foreach ($articles as $article) {
        $stats['total_ventes'] += $article['montant_ventes'];
        $stats['total_retours'] += $article['montant_retours'];
    }

    $stats['montant_net'] = $stats['total_ventes'] - $stats['total_retours'];

    // ===================================================
    // 4. Trier par montant net décroissant
    // ===================================================
    usort($articles, function($a, $b) {
        $net_a = $a['montant_ventes'] - $a['montant_retours'];
        $net_b = $b['montant_ventes'] - $b['montant_retours'];
        return $net_b <=> $net_a;
    });

    // ===================================================
    // 5. Enregistrer le rapport dans la base de données
    // ===================================================
    $numero_rapport = 'A-' . date('Y') . '-' . date('mdHis');

    $insert_rapport = $connexion->prepare("
        INSERT INTO rapports_dgi (
            type_rapport,
            numero_rapport,
            id_session,
            date_generation,
            id_util_generation,
            periode_debut,
            periode_fin,
            donnees_rapport,
            nbre_factures,
            montant_total
        ) VALUES (?, ?, NULL, NOW(), ?, ?, ?, ?, ?, ?)
    ");

    $donnees_json = json_encode([
        'statistiques' => $stats,
        'articles' => $articles,
        'factures' => $factures
    ]);

    $insert_rapport->execute([
        'A',
        $numero_rapport,
        $_SESSION['id_util'] ?? 1,
        $date_debut,
        $date_fin,
        $donnees_json,
        count($articles),
        $stats['montant_net']
    ]);

    // ===================================================
    // 6. Retourner le rapport
    // ===================================================
    echo json_encode([
        'success' => true,
        'numero_rapport' => $numero_rapport,
        'rapport' => [
            'periode' => [
                'date_debut' => $date_debut,
                'date_fin' => $date_fin
            ],
            'statistiques' => $stats,
            'articles' => $articles,
            'nbre_factures' => count($factures)
        ]
    ], JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Erreur: ' . $e->getMessage()
    ]);
}
?>
