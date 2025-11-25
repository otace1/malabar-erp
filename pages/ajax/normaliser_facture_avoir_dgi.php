<?php

/**
 * Script AJAX pour normaliser une facture d'avoir (FA) avec la DGI
 * IMPORTANT: Le processus est IDENTIQUE à normaliser_facture_dgi.php
 * Seule différence: type = 'FA' au lieu de 'FV'
 */

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../../config/api_config.php';
require_once __DIR__ . '/../../classes/DgiApiClient.php';
require_once __DIR__ . '/../../classes/FactureNormalisee.php';
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
    // 1. Récupérer les informations de la facture depuis la base de données
    $query = $connexion->prepare("
        SELECT
            fd.*,
            cl.nom_cli,
            u.id_util,
            u.nom_util
        FROM facture_dossier fd
        LEFT JOIN client cl ON fd.id_cli = cl.id_cli
        LEFT JOIN utilisateur u ON fd.id_util = u.id_util
        WHERE fd.ref_fact = ?
    ");
    $query->execute([$ref_fact]);
    $facture_data = $query->fetch(PDO::FETCH_ASSOC);

    if (!$facture_data) {
        echo json_encode([
            'success' => false,
            'error' => 'Facture non trouvée'
        ]);
        exit;
    }

    // Vérifier si la facture a déjà une facture d'avoir
    if (!empty($facture_data['code_UID_FA'])) {
        echo json_encode([
            'success' => false,
            'error' => 'Cette facture a déjà une facture d\'avoir normalisée DGI'
        ]);
        exit;
    }

    // IMPORTANT: Vérifier que la facture FV a bien été normalisée (code_UID existe)
    if (empty($facture_data['code_UID'])) {
        echo json_encode([
            'success' => false,
            'error' => 'Cette facture doit d\'abord être normalisée (FV) avant de créer une facture d\'avoir (FA)'
        ]);
        exit;
    }

    // Récupérer le Code DEF de la facture FV originale (référence obligatoire pour FA)
    $code_def_fv = $facture_data['code_DEF_DGI'];

    if (empty($code_def_fv)) {
        echo json_encode([
            'success' => false,
            'error' => 'Code DEF DGI manquant - impossible de créer la facture d\'avoir'
        ]);
        exit;
    }

    // 2. Récupérer les détails de la facture (articles/débours)
    $query_items = $connexion->prepare("
        SELECT
            det.*,
            d.nom_deb,
            d.abr_deb,
            dos.roe_decl
        FROM detail_facture_dossier det
        LEFT JOIN debours d ON det.id_deb = d.id_deb
        LEFT JOIN dossier dos ON det.id_dos = dos.id_dos
        WHERE det.ref_fact = ?
        GROUP BY d.id_deb
        ORDER BY d.rang, d.id_deb
    ");
    $query_items->execute([$ref_fact]);
    $items_data = $query_items->fetchAll(PDO::FETCH_ASSOC);

    if (empty($items_data)) {
        echo json_encode([
            'success' => false,
            'error' => 'Aucun détail trouvé pour cette facture'
        ]);
        exit;
    }

    // 3. Préparer les articles pour l'API DGI (prix POSITIFS pour FA)
    $articles = [];
    $total_amount = 0;

    foreach ($items_data as $item) {
        $montant = floatval($item['montant'] ?? 0);
        $roe_decl = floatval($item['roe_decl'] ?? 1);

        // Convertir en USD si nécessaire
        if ($item['usd'] == '0') {
            $price = $montant;
        } else {
            $price = $montant * $roe_decl;
        }

        $quantity = 1;
        $total_amount += $price;

        $articles[] = [
            'code' => 'DEB' . ($item['id_deb'] ?? rand(1000, 9999)),
            'name' => $item['nom_deb'] ?? $item['abr_deb'] ?? 'Service',
            'type' => 'SER',
            'price' => round($price, 2),  // POSITIF
            'quantity' => $quantity,
            'taxGroup' => ($item['tva'] == '1') ? 'B' : 'A'
        ];
    }

    // 4. Préparer les informations du client
    $client = [
        'type' => 'PP',
        'name' => $facture_data['nom_cli'] ?? 'Client Anonyme',
        'nif' => null,
        'contact' => null,
        'address' => null
    ];

    // 5. Préparer le paiement
    $paiements = [[
        'name' => 'ESPECES',
        'amount' => $total_amount
    ]];

    // 6. Préparer l'opérateur
    $operator = [
        'id' => $facture_data['id_util'] ?? 'OP001',
        'name' => $facture_data['nom_util'] ?? 'Opérateur'
    ];

    // 7. Initialiser l'API et créer la facture d'avoir
    $apiClient = new DgiApiClient(API_BASE_URL, API_TOKEN);
    $factureNormalisee = new FactureNormalisee($apiClient, ENTREPRISE_NIF, ENTREPRISE_EMCF_ID);

    // IMPORTANT: Créer une FA avec référence au code_DEF_DGI de la FV
    $result = $factureNormalisee->creer(
        $articles,
        $client,
        $paiements,
        $operator,
        'FA',  // Type FA
        $code_def_fv,  // Référence à la FV originale
        $ref_fact  // Référence de la facture (ref_fact)
    );

    // 8. Si succès, enregistrer dans la base de données
    if ($result['success']) {
        // La FA a son propre UID généré par l'API
        $uid_fa = $result['uid'];

        // IMPORTANT: Mettre à NULL les champs DGI normaux et remplir les champs _FA
        $update_query = $connexion->prepare("
            UPDATE facture_dossier
            SET
                -- Mettre à NULL les champs DGI normaux (FV)
                code_UID = NULL,
                code_DEF_DGI = NULL,
                nim_DGI = NULL,
                type_facture_DGI = NULL,
                nif_DGI = NULL,
                compteur_DGI = NULL,
                qrcode_string_DGI = NULL,
                id_util_DGI = NULL,
                date_DGI = NULL,

                -- Remplir les champs _FA (Facture d'Avoir)
                code_UID_FA = ?,
                code_DEF_DGI_FA = ?,
                nim_DGI_FA = ?,
                type_facture_DGI_FA = ?,
                nif_DGI_FA = ?,
                compteur_DGI_FA = ?,
                qrcode_string_DGI_FA = ?,
                id_util_DGI_FA = ?,
                date_DGI_FA = NOW(),
                facture_origine_ref = ?
            WHERE ref_fact = ?
        ");

        $update_query->execute([
            $uid_fa,  // ← UID de la FV = UID de la FA
            $result['codeDEFDGI'] ?? '',
            $result['nim'] ?? ENTREPRISE_EMCF_ID,
            $result['typeFacture'] ?? 'FA',
            $result['nif'] ?? ENTREPRISE_NIF,
            $result['counters'] ?? '',
            $result['qrCode'] ?? '',
            $facture_data['id_util'],
            $ref_fact, // Référence de la facture d'origine
            $ref_fact
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Facture d\'avoir créée avec succès',
            'data' => [
                'uid' => $uid_fa,  // UID généré par l'API pour la FA
                'codeDEFDGI' => $result['codeDEFDGI'] ?? '',
                'nim' => $result['nim'] ?? ENTREPRISE_EMCF_ID,
                'typeFacture' => 'FA',
                'nif' => $result['nif'] ?? ENTREPRISE_NIF,
                'compteur' => $result['counters'] ?? '',
                'qrCode' => $result['qrCode'] ?? '',
                'dateTime' => $result['dateTime'] ?? date('Y-m-d H:i:s'),
                'factureOrigine' => $ref_fact,
                'codeDEFFVReference' => $code_def_fv
            ]
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => $result['error'] ?? 'Erreur lors de la normalisation de la facture d\'avoir',
            'details' => $result
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Erreur serveur: ' . $e->getMessage()
    ]);
}
