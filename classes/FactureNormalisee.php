<?php
require_once __DIR__ . '/DgiApiClient.php';

/**
 * Classe pour créer des factures normalisées DGI
 */
class FactureNormalisee
{

    private $api;
    private $nif;
    private $emcfId;

    public function __construct(DgiApiClient $api, $nif, $emcfId)
    {
        $this->api = $api;
        $this->nif = $nif;
        $this->emcfId = $emcfId;
    }

    /**
     * Créer et confirmer une facture normalisée
     *
     * @param array $articles Liste des articles [code, name, price, quantity, taxGroup]
     * @param array $client Informations client [type, name, nif, contact, address]
     * @param array $paiements Modes de paiement [name, amount]
     * @param array $operator Info opérateur [id, name]
     * @param string $typeFacture Type: FV, FA, FT (défaut: FV)
     * @return array Résultat avec uid, qrCode, codeDEFDGI
     */
    public function creer($articles, $client, $paiements, $operator, $typeFacture = 'FV')
    {

        // 1. Préparer les items
        $items = [];
        foreach ($articles as $article) {
            $items[] = [
                'code' => $article['code'] ?? 'ART' . rand(1000, 9999),
                'name' => $article['name'],
                'type' => $article['type'] ?? 'BIE', // BIE ou SER
                'price' => (float)$article['price'],
                'quantity' => (float)$article['quantity'],
                'taxGroup' => $article['taxGroup'] ?? 'A'
            ];
        }

        // 2. Préparer le client
        $clientData = [
            'nif' => $client['nif'] ?? null,
            'type' => $client['type'] ?? 'PP', // PP, PM, PC
            'name' => $client['name'],
            'contact' => $client['contact'] ?? null,
            'address' => $client['address'] ?? null
        ];

        // 3. Préparer les paiements
        $paymentData = [];
        foreach ($paiements as $paiement) {
            $paymentData[] = [
                'name' => $paiement['name'], // ESPECES, MOBILEMONEY, etc.
                'amount' => (float)$paiement['amount']
            ];
        }

        // 4. Construire la requête complète
        $factureData = [
            'nif' => $this->nif,
            'rn' => date('Y') . '/' . date('mdHis') . rand(10, 99), // Numéro unique: 2025/11171523001
            'mode' => 'ht',  // ht = Hors Taxes, ttc = Toutes Taxes Comprises
            'isf' => $this->emcfId,
            'type' => $typeFacture,
            'items' => $items,
            'client' => $clientData,
            'operator' => [
                'id' => $operator['id'] ?? 'OP001',
                'name' => $operator['name'] ?? 'Caissier'
            ],
            'payment' => $paymentData,
            'reference' => 'REF-' . date('YmdHis') . '-' . rand(1000, 9999),
            'referenceType' => 'BON'
        ];

        // 5. Créer la facture
        $createResult = $this->api->createInvoice($factureData);

        if (!$createResult['success']) {
            return [
                'success' => false,
                'error' => 'Erreur création facture: ' . ($createResult['data']['errorDesc'] ?? $createResult['error'] ?? 'Erreur inconnue'),
                'httpCode' => $createResult['httpCode'],
                'response' => $createResult['data'] ?? null
            ];
        }

        $uid = $createResult['data']['uid'] ?? null;
        $total = $createResult['data']['total'] ?? 0;
        $vtotal = $createResult['data']['vtotal'] ?? 0;

        // 6. Confirmer la facture pour obtenir le QR Code
        $confirmResult = $this->api->confirmInvoice($uid, $total, $vtotal);

        if (!$confirmResult['success']) {
            return [
                'success' => false,
                'error' => 'Erreur confirmation facture: ' . ($confirmResult['data']['errorDesc'] ?? $confirmResult['error'] ?? 'Erreur inconnue'),
                'httpCode' => $confirmResult['httpCode'],
                'uid' => $uid,
                'response' => $confirmResult['data'] ?? null
            ];
        }

        // 7. Retourner tous les détails
        return [
            'success' => true,
            'uid' => $uid,
            'total' => $total,
            'vtotal' => $vtotal,
            'qrCode' => $confirmResult['data']['qrCode'],
            'codeDEFDGI' => $confirmResult['data']['codeDEFDGI'],
            'dateTime' => $confirmResult['data']['dateTime'],
            'counters' => $confirmResult['data']['counters'],
            'nim' => $confirmResult['data']['nim']
        ];
    }

    /**
     * Obtenir les détails d'une facture existante
     */
    public function getDetails($uid)
    {
        return $this->api->getInvoice($uid);
    }

    /**
     * Annuler une facture
     */
    public function annuler($uid)
    {
        return $this->api->cancelInvoice($uid);
    }
}
