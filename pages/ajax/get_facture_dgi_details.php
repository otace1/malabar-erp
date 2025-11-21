<?php

/**
 * Script AJAX pour récupérer les détails DGI d'une facture
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../classes/connexion.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'error' => 'Méthode non autorisée'
    ]);
    exit;
}

// Récupérer la référence de la facture
$ref_fact = $_POST['ref_fact'] ?? null;

if (!$ref_fact) {
    echo json_encode([
        'success' => false,
        'error' => 'Référence de facture manquante'
    ]);
    exit;
}

try {
    // Récupérer les informations DGI de la facture
    $query = $connexion->prepare("
        SELECT
            fd.code_UID,
            fd.code_DEF_DGI,
            fd.nim_DGI,
            fd.type_facture_DGI,
            fd.nif_DGI,
            fd.compteur_DGI,
            fd.qrcode_string_DGI,
            fd.id_util_DGI,
            fd.date_DGI,
            u.nom_util
        FROM facture_dossier fd
        LEFT JOIN utilisateur u ON fd.id_util_DGI = u.id_util
        WHERE fd.ref_fact = ?
    ");
    $query->execute([$ref_fact]);
    $facture_dgi = $query->fetch(PDO::FETCH_ASSOC);

    if (!$facture_dgi) {
        echo json_encode([
            'success' => false,
            'error' => 'Facture non trouvée'
        ]);
        exit;
    }

    if (empty($facture_dgi['code_UID'])) {
        echo json_encode([
            'success' => false,
            'error' => 'Cette facture n\'est pas encore normalisée DGI'
        ]);
        exit;
    }

    echo json_encode([
        'success' => true,
        'data' => [
            'code_UID' => $facture_dgi['code_UID'],
            'code_DEF_DGI' => $facture_dgi['code_DEF_DGI'],
            'nim_DGI' => $facture_dgi['nim_DGI'],
            'type_facture_DGI' => $facture_dgi['type_facture_DGI'],
            'nif_DGI' => $facture_dgi['nif_DGI'],
            'compteur_DGI' => $facture_dgi['compteur_DGI'],
            'qrcode_string_DGI' => $facture_dgi['qrcode_string_DGI'],
            'date_DGI' => $facture_dgi['date_DGI'],
            'nom_util' => $facture_dgi['nom_util'] ?? 'N/A'
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Erreur serveur: ' . $e->getMessage()
    ]);
}
