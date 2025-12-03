<?php
/**
 * Script AJAX pour lister les sessions et rapports DGI
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../classes/connexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
    exit;
}

$operation = $_POST['operation'] ?? null;

try {
    switch ($operation) {
        case 'lister_sessions':
            listerSessions($connexion);
            break;

        case 'lister_rapports':
            listerRapports($connexion);
            break;

        case 'details_session':
            $id_session = $_POST['id_session'] ?? null;
            if (!$id_session) {
                throw new Exception('ID session manquant');
            }
            detailsSession($connexion, $id_session);
            break;

        default:
            throw new Exception('Opération invalide');
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

// Lister toutes les sessions
function listerSessions($connexion) {
    // Session active
    $query_active = $connexion->prepare("
        SELECT
            s.*,
            u.nom_util as utilisateur_ouverture
        FROM sessions_dgi s
        LEFT JOIN utilisateur u ON s.id_util_ouverture = u.id_util
        WHERE s.statut_session = 'active'
        ORDER BY s.date_debut DESC
        LIMIT 1
    ");
    $query_active->execute();
    $session_active = $query_active->fetch(PDO::FETCH_ASSOC);

    // Toutes les sessions
    $query_sessions = $connexion->prepare("
        SELECT
            s.*,
            u1.nom_util as utilisateur_ouverture,
            u2.nom_util as utilisateur_cloture
        FROM sessions_dgi s
        LEFT JOIN utilisateur u1 ON s.id_util_ouverture = u1.id_util
        LEFT JOIN utilisateur u2 ON s.id_util_cloture = u2.id_util
        ORDER BY s.date_debut DESC
    ");
    $query_sessions->execute();
    $sessions = $query_sessions->fetchAll(PDO::FETCH_ASSOC);

    // Statistiques globales
    $query_stats = $connexion->query("
        SELECT
            COUNT(*) as total_sessions,
            SUM(CASE WHEN statut_session = 'cloturee' THEN 1 ELSE 0 END) as sessions_cloturees,
            SUM(nbre_factures_total) as total_factures,
            SUM(montant_total_ttc) as montant_total_ttc
        FROM sessions_dgi
    ");
    $stats = $query_stats->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'session_active' => $session_active,
        'sessions' => $sessions,
        'statistiques' => [
            'total_sessions' => $stats['total_sessions'] ?? 0,
            'sessions_cloturees' => $stats['sessions_cloturees'] ?? 0,
            'total_factures' => $stats['total_factures'] ?? 0,
            'montant_total_ttc' => $stats['montant_total_ttc'] ?? 0
        ]
    ], JSON_PRETTY_PRINT);
}

// Lister tous les rapports
function listerRapports($connexion) {
    $query_rapports = $connexion->prepare("
        SELECT
            r.*,
            s.numero_session,
            u.nom_util as utilisateur
        FROM rapports_dgi r
        LEFT JOIN sessions_dgi s ON r.id_session = s.id_session
        LEFT JOIN utilisateur u ON r.id_util_generation = u.id_util
        ORDER BY r.date_generation DESC
    ");
    $query_rapports->execute();
    $rapports = $query_rapports->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'rapports' => $rapports
    ], JSON_PRETTY_PRINT);
}

// Détails d'une session
function detailsSession($connexion, $id_session) {
    $query_session = $connexion->prepare("
        SELECT
            s.*,
            u1.nom_util as utilisateur_ouverture,
            u2.nom_util as utilisateur_cloture
        FROM sessions_dgi s
        LEFT JOIN utilisateur u1 ON s.id_util_ouverture = u1.id_util
        LEFT JOIN utilisateur u2 ON s.id_util_cloture = u2.id_util
        WHERE s.id_session = ?
    ");
    $query_session->execute([$id_session]);
    $session = $query_session->fetch(PDO::FETCH_ASSOC);

    if (!$session) {
        throw new Exception('Session introuvable');
    }

    echo json_encode([
        'success' => true,
        'session' => $session
    ], JSON_PRETTY_PRINT);
}
?>
