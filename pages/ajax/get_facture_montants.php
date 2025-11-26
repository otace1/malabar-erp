<?php

/**
 * Script AJAX pour récupérer les montants d'une facture (HT, TVA, TTC)
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
    // Récupérer les détails de la facture (même requête que normaliser_facture_dgi.php)
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

    // Calculer les montants HT, TVA et TTC
    $montant_ht = 0;
    $montant_tva = 0;

    foreach ($items_data as $item) {
        $montant = floatval($item['montant'] ?? 0);
        $roe_decl = floatval($item['roe_decl'] ?? 1);
        $tva = intval($item['tva'] ?? 0);

        // Convertir en CDF si nécessaire (usd='0' = déjà en CDF, usd='1' = en USD à convertir)
        if ($item['usd'] == '0') {
            $price_ht = $montant;
        } else {
            $price_ht = $montant * $roe_decl;
        }

        // Ajouter au montant HT
        $montant_ht += $price_ht;

        // Si TVA applicable (tva = 1), calculer 16%
        if ($tva == 1) {
            $montant_tva += ($price_ht * 0.16);
        }
    }

    // Calculer le TTC
    $montant_ttc = $montant_ht + $montant_tva;

    // Formater les montants
    echo json_encode([
        'success' => true,
        'data' => [
            'montant_ht' => round($montant_ht, 2),
            'montant_tva' => round($montant_tva, 2),
            'montant_ttc' => round($montant_ttc, 2),
            'montant_ht_formatted' => number_format(round($montant_ht, 2), 2, ',', ' '),
            'montant_tva_formatted' => number_format(round($montant_tva, 2), 2, ',', ' '),
            'montant_ttc_formatted' => number_format(round($montant_ttc, 2), 2, ',', ' '),
            'devise' => 'USD'
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Erreur serveur: ' . $e->getMessage()
    ]);
}
