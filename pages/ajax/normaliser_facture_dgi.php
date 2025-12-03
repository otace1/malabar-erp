<?php

/**
 * Script AJAX pour normaliser une facture avec la DGI
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
            cl.nif_cli,
            cl.adr_cli,
            cl.tel_cli,
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

    // 3. Préparer les articles pour l'API DGI
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

        $quantity = 1; // Pour les débours, quantité = 1
        $total_amount += $price;

        $articles[] = [
            'code' => 'DEB' . ($item['id_deb'] ?? rand(1000, 9999)),
            'name' => $item['nom_deb'] ?? $item['abr_deb'] ?? 'Service',
            'type' => 'SER', // SER = Service (car ce sont des débours/services)
            'price' => round($price, 2),
            'quantity' => $quantity,
            'taxGroup' => ($item['tva'] == '1') ? 'B' : 'A' // B = 16% TVA, A = 0%
        ];
    }

    // 4. Préparer les informations du client
    $client = [
        'type' => 'PM', // PM = Personne Morale (obligatoire pour toutes les factures)
        'name' => $facture_data['nom_cli'] ?? 'Client Anonyme',
        'nif' => $facture_data['nif_cli'] ?? null,
        'contact' => $facture_data['tel_cli'] ?? null,
        'address' => $facture_data['adr_cli'] ?? null
    ];

    // 5. Préparer le paiement
    $paiements = [[
        'name' => 'ESPECES', // ESPECES, MOBILEMONEY, CHEQUE, VIREMENT, CARTE
        'amount' => $total_amount
    ]];

    // 6. Préparer l'opérateur
    $operator = [
        'id' => $facture_data['id_util'] ?? 'OP001',
        'name' => $facture_data['nom_util'] ?? 'Opérateur'
    ];

    // 7. Initialiser l'API et créer la facture normalisée
    $apiClient = new DgiApiClient(API_BASE_URL, API_TOKEN);
    $factureNormalisee = new FactureNormalisee($apiClient, ENTREPRISE_NIF, ENTREPRISE_EMCF_ID);

    // Type de facture: FV = Facture de Vente, FA = Facture d'Avoir, FT = Facture Temporaire
    $typeFacture = 'FV';

    $result = $factureNormalisee->creer($articles, $client, $paiements, $operator, $typeFacture, null, $ref_fact);

    // 8. Si succès, enregistrer dans la base de données
    if ($result['success']) {
        $update_query = $connexion->prepare("
            UPDATE facture_dossier
            SET
                code_UID = ?,
                code_DEF_DGI = ?,
                nim_DGI = ?,
                type_facture_DGI = ?,
                nif_DGI = ?,
                compteur_DGI = ?,
                qrcode_string_DGI = ?,
                id_util_DGI = ?,
                date_DGI = NOW()
            WHERE ref_fact = ?
        ");

        $update_query->execute([
            $result['uid'],
            $result['codeDEFDGI'],
            $result['nim'] ?? ENTREPRISE_EMCF_ID,
            $typeFacture,
            $result['nif'] ?? ENTREPRISE_NIF,
            $result['counters'] ?? '',
            $result['qrCode'] ?? '',
            $facture_data['id_util'],
            $ref_fact
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Facture normalisée avec succès',
            'data' => [
                'uid' => $result['uid'],
                'codeDEFDGI' => $result['codeDEFDGI'],
                'nim' => $result['nim'] ?? ENTREPRISE_EMCF_ID,
                'typeFacture' => $typeFacture,
                'nif' => $result['nif'] ?? ENTREPRISE_NIF,
                'compteur' => $result['counters'] ?? '',
                'qrCode' => $result['qrCode'],
                'dateTime' => $result['dateTime']
            ]
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => $result['error'] ?? 'Erreur lors de la normalisation',
            'details' => $result
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Erreur serveur: ' . $e->getMessage()
    ]);
}
