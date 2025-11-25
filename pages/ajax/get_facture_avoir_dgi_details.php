<?php

/**
 * Script AJAX pour récupérer les détails DGI d'une facture d'avoir (FA)
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
    // Récupérer les informations DGI de la facture d'avoir
    $query = $connexion->prepare("
        SELECT
            fd.code_UID_FA,
            fd.code_DEF_DGI_FA,
            fd.nim_DGI_FA,
            fd.type_facture_DGI_FA,
            fd.nif_DGI_FA,
            fd.compteur_DGI_FA,
            fd.qrcode_string_DGI_FA,
            fd.id_util_DGI_FA,
            fd.date_DGI_FA,
            fd.facture_origine_ref,
            u.nom_util
        FROM facture_dossier fd
        LEFT JOIN utilisateur u ON fd.id_util_DGI_FA = u.id_util
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

    if (empty($facture_dgi['code_UID_FA'])) {
        echo json_encode([
            'success' => false,
            'error' => 'Cette facture n\'a pas encore de facture d\'avoir normalisée DGI'
        ]);
        exit;
    }

    echo json_encode([
        'success' => true,
        'data' => [
            'code_UID_FA' => $facture_dgi['code_UID_FA'],
            'code_DEF_DGI_FA' => $facture_dgi['code_DEF_DGI_FA'],
            'nim_DGI_FA' => $facture_dgi['nim_DGI_FA'],
            'type_facture_DGI_FA' => $facture_dgi['type_facture_DGI_FA'],
            'nif_DGI_FA' => $facture_dgi['nif_DGI_FA'],
            'compteur_DGI_FA' => $facture_dgi['compteur_DGI_FA'],
            'qrcode_string_DGI_FA' => $facture_dgi['qrcode_string_DGI_FA'],
            'date_DGI_FA' => $facture_dgi['date_DGI_FA'],
            'facture_origine_ref' => $facture_dgi['facture_origine_ref'],
            'nom_util' => $facture_dgi['nom_util'] ?? 'N/A'
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Erreur serveur: ' . $e->getMessage()
    ]);
}
