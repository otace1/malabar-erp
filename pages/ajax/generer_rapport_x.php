<?php
/**
 * Script AJAX pour générer le X-Rapport DGI
 * Le X-Rapport est un rapport de consultation de la session active
 * sans fermer la session
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../classes/connexion.php';
require_once __DIR__ . '/../../config/api_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'error' => 'Méthode non autorisée'
    ]);
    exit;
}

$operation = $_POST['operation'] ?? null;
$mode = $_POST['mode'] ?? 'quotidien';
$date_debut_perso = $_POST['date_debut'] ?? null;
$date_fin_perso = $_POST['date_fin'] ?? null;

if ($operation !== 'generer_rapport_x') {
    echo json_encode([
        'success' => false,
        'error' => 'Opération invalide'
    ]);
    exit;
}

try {
    $date_debut_periode = null;
    $date_fin_periode = null;
    $session = null;

    // ===================================================
    // 1. Déterminer la période selon le mode
    // ===================================================
    if ($mode === 'periodique') {
        // Mode périodique : utiliser les dates fournies
        if (!$date_debut_perso || !$date_fin_perso) {
            throw new Exception('Dates de période manquantes');
        }
        $date_debut_periode = $date_debut_perso . ' 00:00:00';
        $date_fin_periode = $date_fin_perso . ' 23:59:59';

        // Créer une session "virtuelle" pour compatibilité
        $session = [
            'id_session' => null,
            'numero_session' => 'X-PERIODIQUE-' . date('YmdHis'),
            'date_debut' => $date_debut_periode,
            'date_fin' => $date_fin_periode,
            'utilisateur_ouverture' => $_SESSION['nom_util'] ?? 'Système',
            'statut_session' => 'consultation'
        ];

    } else {
        // Mode quotidien : utiliser la session active (depuis dernier Z-Rapport)
        $query_session = $connexion->prepare("
            SELECT
                s.*,
                u.nom_util as utilisateur_ouverture
            FROM sessions_dgi s
            LEFT JOIN utilisateur u ON s.id_util_ouverture = u.id_util
            WHERE s.statut_session = 'active'
            ORDER BY s.date_debut DESC
            LIMIT 1
        ");
        $query_session->execute();
        $session = $query_session->fetch(PDO::FETCH_ASSOC);

        if (!$session) {
            // Aucune session active, créer une nouvelle
            // Commencer au début du mois pour inclure toutes les factures du mois
            $date_debut_session = date('Y-m-01 00:00:00');
            $numero_session = 'Z-' . date('Y') . '-' . str_pad(1, 3, '0', STR_PAD_LEFT);

            $create_session = $connexion->prepare("
                INSERT INTO sessions_dgi (
                    numero_session,
                    date_debut,
                    statut_session,
                    id_util_ouverture
                ) VALUES (?, ?, 'active', ?)
            ");
            $create_session->execute([$numero_session, $date_debut_session, $_SESSION['id_util'] ?? 1]);

            // Récupérer la session créée
            $query_session->execute();
            $session = $query_session->fetch(PDO::FETCH_ASSOC);
        }

        $date_debut_periode = $session['date_debut'];
        $date_fin_periode = null; // Jusqu'à maintenant
    }

    // ===================================================
    // 2. Récupérer TOUTES les factures normalisées de la période
    // IMPORTANT: Utiliser UNION pour séparer FV et FA
    // ===================================================
    if ($date_fin_periode) {
        // Période avec date de fin
        $query_factures = $connexion->prepare("
            -- Factures de Vente (FV)
            SELECT
                fd.ref_fact,
                fd.date_fact,
                fd.date_DGI,
                fd.code_DEF_DGI as code_def,
                fd.code_UID as code_uid,
                'FV' as type_facture,
                cl.nom_cli,
                cl.id_cli
            FROM facture_dossier fd
            LEFT JOIN client cl ON fd.id_cli = cl.id_cli
            WHERE fd.date_DGI >= ?
                AND fd.date_DGI <= ?
                AND fd.date_DGI IS NOT NULL
                AND fd.code_UID IS NOT NULL

            UNION ALL

            -- Factures d'Avoir (FA)
            SELECT
                fd.ref_fact,
                fd.date_fact,
                fd.date_DGI_FA as date_DGI,
                fd.code_DEF_DGI_FA as code_def,
                fd.code_UID_FA as code_uid,
                'FA' as type_facture,
                cl.nom_cli,
                cl.id_cli
            FROM facture_dossier fd
            LEFT JOIN client cl ON fd.id_cli = cl.id_cli
            WHERE fd.date_DGI_FA >= ?
                AND fd.date_DGI_FA <= ?
                AND fd.date_DGI_FA IS NOT NULL
                AND fd.code_UID_FA IS NOT NULL

            ORDER BY date_DGI ASC
        ");
        $query_factures->execute([$date_debut_periode, $date_fin_periode, $date_debut_periode, $date_fin_periode]);
    } else {
        // Depuis date de début jusqu'à maintenant
        $query_factures = $connexion->prepare("
            -- Factures de Vente (FV)
            SELECT
                fd.ref_fact,
                fd.date_fact,
                fd.date_DGI,
                fd.code_DEF_DGI as code_def,
                fd.code_UID as code_uid,
                'FV' as type_facture,
                cl.nom_cli,
                cl.id_cli
            FROM facture_dossier fd
            LEFT JOIN client cl ON fd.id_cli = cl.id_cli
            WHERE fd.date_DGI >= ?
                AND fd.date_DGI IS NOT NULL
                AND fd.code_UID IS NOT NULL

            UNION ALL

            -- Factures d'Avoir (FA)
            SELECT
                fd.ref_fact,
                fd.date_fact,
                fd.date_DGI_FA as date_DGI,
                fd.code_DEF_DGI_FA as code_def,
                fd.code_UID_FA as code_uid,
                'FA' as type_facture,
                cl.nom_cli,
                cl.id_cli
            FROM facture_dossier fd
            LEFT JOIN client cl ON fd.id_cli = cl.id_cli
            WHERE fd.date_DGI_FA >= ?
                AND fd.date_DGI_FA IS NOT NULL
                AND fd.code_UID_FA IS NOT NULL

            ORDER BY date_DGI ASC
        ");
        $query_factures->execute([$date_debut_periode, $date_debut_periode]);
    }
    $factures = $query_factures->fetchAll(PDO::FETCH_ASSOC);

    // ===================================================
    // 3. Calculer les statistiques pour chaque facture
    // ===================================================
    $factures_details = [];
    $stats_globales = [
        'nbre_factures_total' => 0,
        'nbre_factures_fv' => 0,
        'nbre_factures_fa' => 0,
        'montant_total_ht' => 0,
        'montant_total_tva' => 0,
        'montant_total_ttc' => 0
    ];

    $par_type_facture = [];
    $par_groupe_taxation = [];
    $par_mode_paiement = ['VIREMENT' => 0];

    foreach ($factures as $facture) {
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

        $montant_ht_facture = 0;
        $montant_tva_facture = 0;
        $montant_ttc_facture = 0;

        foreach ($details as $detail) {
            $montant = floatval($detail['montant'] ?? 0);
            $montant_tva_detail = floatval($detail['montant_tva'] ?? 0);
            $roe = floatval($detail['roe_decl'] ?? 1);
            $tva = $detail['tva'] == '1';
            $usd = $detail['usd'] == '1';

            // Convertir en USD si nécessaire
            if (!$usd) {
                $montant = $montant / $roe;
                if ($montant_tva_detail > 0) {
                    $montant_tva_detail = $montant_tva_detail / $roe;
                }
            }

            // Calculer TVA si applicable
            if ($tva) {
                if ($montant_tva_detail > 0) {
                    $tva_calcule = $montant_tva_detail;
                } else {
                    $tva_calcule = $montant * 0.16;
                }
            } else {
                $tva_calcule = 0;
            }

            $montant_ht_facture += $montant;
            $montant_tva_facture += $tva_calcule;

            // Grouper par type de taxation
            $groupe_tax = $tva ? 'B' : 'A';
            if (!isset($par_groupe_taxation[$groupe_tax])) {
                $par_groupe_taxation[$groupe_tax] = [
                    'nombre' => 0,
                    'montant_ht' => 0,
                    'montant_tva' => 0,
                    'montant_ttc' => 0
                ];
            }
            $par_groupe_taxation[$groupe_tax]['montant_ht'] += $montant;
            $par_groupe_taxation[$groupe_tax]['montant_tva'] += $tva_calcule;
        }

        $montant_ttc_facture = $montant_ht_facture + $montant_tva_facture;

        // Ajouter aux statistiques globales
        $stats_globales['nbre_factures_total']++;
        $stats_globales['montant_total_ht'] += $montant_ht_facture;
        $stats_globales['montant_total_tva'] += $montant_tva_facture;
        $stats_globales['montant_total_ttc'] += $montant_ttc_facture;

        // Par type de facture
        $type = $facture['type_facture'];
        if (!isset($par_type_facture[$type])) {
            $par_type_facture[$type] = [
                'nombre' => 0,
                'montant_ht' => 0,
                'montant_tva' => 0,
                'montant_ttc' => 0
            ];
        }
        $par_type_facture[$type]['nombre']++;
        $par_type_facture[$type]['montant_ht'] += $montant_ht_facture;
        $par_type_facture[$type]['montant_tva'] += $montant_tva_facture;
        $par_type_facture[$type]['montant_ttc'] += $montant_ttc_facture;

        // Compter par type
        if ($type === 'FV') {
            $stats_globales['nbre_factures_fv']++;
        } else if ($type === 'FA') {
            $stats_globales['nbre_factures_fa']++;
        }

        // Mode de paiement (par défaut ESPECES pour simplifier)
        $par_mode_paiement['VIREMENT'] += $montant_ttc_facture;

        // Ajouter aux détails
        $factures_details[] = [
            'ref_fact' => $facture['ref_fact'],
            'date_fact' => $facture['date_fact'],
            'type_facture' => $type,
            'nom_cli' => $facture['nom_cli'],
            'code_def' => $facture['code_def'],
            'montant_ht' => $montant_ht_facture,
            'montant_tva' => $montant_tva_facture,
            'montant_ttc' => $montant_ttc_facture
        ];
    }

    // Finaliser les groupes de taxation
    foreach ($par_groupe_taxation as $groupe => &$data) {
        $data['montant_ttc'] = $data['montant_ht'] + $data['montant_tva'];
        $data['nombre'] = $stats_globales['nbre_factures_total']; // À affiner si besoin
    }

    // ===================================================
    // 4. Préparer la réponse
    // ===================================================
    $rapport = [
        'session' => [
            'id_session' => $session['id_session'],
            'numero_session' => $session['numero_session'],
            'date_debut' => $session['date_debut'],
            'utilisateur_ouverture' => $session['utilisateur_ouverture']
        ],
        'statistiques' => $stats_globales,
        'par_type_facture' => $par_type_facture,
        'par_groupe_taxation' => $par_groupe_taxation,
        'par_mode_paiement' => $par_mode_paiement,
        'factures' => $factures_details
    ];

    echo json_encode([
        'success' => true,
        'rapport' => $rapport,
        'session' => $session
    ], JSON_PRETTY_PRINT);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Erreur serveur: ' . $e->getMessage()
    ]);
}
?>
