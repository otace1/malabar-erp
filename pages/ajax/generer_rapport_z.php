<?php
/**
 * Script AJAX pour générer le Z-Rapport DGI et clôturer la session
 * Le Z-Rapport est DÉFINITIF et ferme la session active
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../classes/connexion.php';
require_once __DIR__ . '/../../config/api_config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
    exit;
}

$operation = $_POST['operation'] ?? null;
$id_session = $_POST['id_session'] ?? null;

if ($operation !== 'cloturer_session' || !$id_session) {
    echo json_encode(['success' => false, 'error' => 'Paramètres invalides']);
    exit;
}

try {
    $connexion->beginTransaction();

    // ===================================================
    // 1. Vérifier que la session existe et est active
    // ===================================================
    $query_session = $connexion->prepare("
        SELECT * FROM sessions_dgi
        WHERE id_session = ? AND statut_session = 'active'
    ");
    $query_session->execute([$id_session]);
    $session = $query_session->fetch(PDO::FETCH_ASSOC);

    if (!$session) {
        throw new Exception('Session introuvable ou déjà clôturée');
    }

    // ===================================================
    // 2. Récupérer toutes les factures de la session
    // IMPORTANT: UNION pour séparer FV et FA
    // ===================================================
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
    $query_factures->execute([$session['date_debut'], $session['date_debut']]);
    $factures = $query_factures->fetchAll(PDO::FETCH_ASSOC);

    // ===================================================
    // 3. Calculer les statistiques complètes
    // ===================================================
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

    foreach ($factures as $facture) {
        $query_details = $connexion->prepare("
            SELECT dfd.*, d.nom_deb, dos.roe_decl
            FROM detail_facture_dossier dfd
            LEFT JOIN debours d ON dfd.id_deb = d.id_deb
            LEFT JOIN dossier dos ON dfd.id_dos = dos.id_dos
            WHERE dfd.ref_fact = ?
        ");
        $query_details->execute([$facture['ref_fact']]);
        $details = $query_details->fetchAll(PDO::FETCH_ASSOC);

        $montant_ht_facture = 0;
        $montant_tva_facture = 0;

        foreach ($details as $detail) {
            $montant = floatval($detail['montant'] ?? 0);
            $roe = floatval($detail['roe_decl'] ?? 1);
            $tva = $detail['tva'] == '1';
            $usd = $detail['usd'] == '1';

            if (!$usd) {
                $montant = $montant / $roe;
            }

            if ($tva) {
                $tva_calcule = floatval($detail['montant_tva'] ?? 0);
                if ($tva_calcule == 0) {
                    $tva_calcule = $montant * 0.16;
                }
                if (!$usd) {
                    $tva_calcule = $tva_calcule / $roe;
                }
            } else {
                $tva_calcule = 0;
            }

            $montant_ht_facture += $montant;
            $montant_tva_facture += $tva_calcule;
        }

        $montant_ttc_facture = $montant_ht_facture + $montant_tva_facture;

        $stats_globales['nbre_factures_total']++;
        $stats_globales['montant_total_ht'] += $montant_ht_facture;
        $stats_globales['montant_total_tva'] += $montant_tva_facture;
        $stats_globales['montant_total_ttc'] += $montant_ttc_facture;

        // Type de facture retourné par la requête UNION
        $type = $facture['type_facture'];
        if ($type === 'FV') {
            $stats_globales['nbre_factures_fv']++;
        } else if ($type === 'FA') {
            $stats_globales['nbre_factures_fa']++;
        }
    }

    // ===================================================
    // 4. Mettre à jour la session avec les statistiques
    // ===================================================
    $update_session = $connexion->prepare("
        UPDATE sessions_dgi SET
            date_fin = NOW(),
            statut_session = 'cloturee',
            id_util_cloture = ?,
            nbre_factures_total = ?,
            nbre_factures_fv = ?,
            nbre_factures_fa = ?,
            montant_total_ht = ?,
            montant_total_tva = ?,
            montant_total_ttc = ?
        WHERE id_session = ?
    ");
    $update_session->execute([
        $_SESSION['id_util'] ?? 1,
        $stats_globales['nbre_factures_total'],
        $stats_globales['nbre_factures_fv'],
        $stats_globales['nbre_factures_fa'],
        $stats_globales['montant_total_ht'],
        $stats_globales['montant_total_tva'],
        $stats_globales['montant_total_ttc'],
        $id_session
    ]);

    // ===================================================
    // 5. Créer l'enregistrement du rapport Z
    // ===================================================
    $numero_rapport = 'Z-' . date('Y') . '-' . $session['numero_session'];
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
        ) VALUES (?, ?, ?, NOW(), ?, ?, NOW(), ?, ?, ?)
    ");

    $donnees_json = json_encode([
        'session' => $session,
        'statistiques' => $stats_globales,
        'factures' => $factures
    ]);

    $insert_rapport->execute([
        'Z',
        $numero_rapport,
        $id_session,
        $_SESSION['id_util'] ?? 1,
        $session['date_debut'],
        $donnees_json,
        $stats_globales['nbre_factures_total'],
        $stats_globales['montant_total_ttc']
    ]);

    // ===================================================
    // 6. Créer une nouvelle session active
    // ===================================================
    // Extraire le numéro de la session précédente et incrémenter
    preg_match('/Z-(\d{4})-(\d+)/', $session['numero_session'], $matches);
    $annee = $matches[1] ?? date('Y');
    $numero = isset($matches[2]) ? intval($matches[2]) + 1 : 1;
    $nouveau_numero_session = 'Z-' . $annee . '-' . str_pad($numero, 3, '0', STR_PAD_LEFT);

    $create_nouvelle_session = $connexion->prepare("
        INSERT INTO sessions_dgi (
            numero_session,
            date_debut,
            statut_session,
            id_util_ouverture
        ) VALUES (?, NOW(), 'active', ?)
    ");
    $create_nouvelle_session->execute([
        $nouveau_numero_session,
        $_SESSION['id_util'] ?? 1
    ]);

    $connexion->commit();

    // ===================================================
    // 7. Retourner le succès
    // ===================================================
    echo json_encode([
        'success' => true,
        'rapport' => [
            'numero_rapport' => $numero_rapport,
            'id_session' => $id_session,
            'statistiques' => $stats_globales
        ],
        'nouvelle_session' => $nouveau_numero_session
    ], JSON_PRETTY_PRINT);

} catch (Exception $e) {
    $connexion->rollBack();
    echo json_encode([
        'success' => false,
        'error' => 'Erreur: ' . $e->getMessage()
    ]);
}
?>
