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
     * Créer et confirmer une facture normalisée (FV, FT, FA, etc.)
     *
     * @param array $articles Liste des articles [code, name, price, quantity, taxGroup]
     * @param array $client Informations client [type, name, nif, contact, address]
     * @param array $paiements Modes de paiement [name, amount]
     * @param array $operator Info opérateur [id, name]
     * @param string $typeFacture Type: FV, FA, FT (défaut: FV)
     * @param string|null $referenceFactureOriginale Code DEF de la FV pour créer une FA
     * @param string|null $refFacture Référence de la facture (ref_fact) pour le champ rn
     * @return array Résultat avec uid, qrCode, codeDEFDGI
     */
    public function creer($articles, $client, $paiements, $operator, $typeFacture = 'FV', $referenceFactureOriginale = null, $refFacture = null)
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

        // Générer un numéro de référence avec ref_fact ou timestamp
        if ($refFacture) {
            // Utiliser la référence de la facture (ref_fact)
            $rn = $refFacture;
        } else {
            // Fallback : utiliser uniquement le timestamp
            $rn = $refFacture;
        }

        $factureData = [
            'nif' => $this->nif,
            'rn' => $rn,
            'mode' => 'ht',  // ht = Hors Taxes, ttc = Toutes Taxes Comprises
            'isf' => $this->emcfId,
            'type' => $typeFacture,
            'items' => $items,
            'client' => $clientData,
            'operator' => [
                'id' => $operator['id'] ?? 'OP001',
                'name' => $operator['name'] ?? 'Caissier'
            ],
            'payment' => $paymentData
        ];

        // IMPORTANT: Pour une FA, utiliser le code_DEF_DGI de la FV comme référence
        // et referenceType="RAM" (comme dans l'exemple API DGI)
        if ($typeFacture === 'FA' && $referenceFactureOriginale) {
            $factureData['reference'] = $referenceFactureOriginale;
            $factureData['referenceType'] = 'RAM';  // ← RAM pour FA !
        } else {
            $factureData['reference'] = 'REF-' . date('YmdHis') . '-' . rand(1000, 9999);
            $factureData['referenceType'] = 'BON';
        }

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

        // Extraction des données de création
        $responseData = $createResult['data'] ?? [];
        $uid = $responseData['uid'] ?? null;
        $total = $responseData['total'] ?? 0;
        $vtotal = $responseData['vtotal'] ?? 0;

        // IMPORTANT: Si UID est NULL, la création a échoué
        if ($uid === null || $uid === '') {
            return [
                'success' => false,
                'error' => 'API n\'a pas retourné d\'UID - Création échouée',
                'httpCode' => $createResult['httpCode'] ?? 0,
                'response' => $responseData,
                'fullResponse' => $createResult
            ];
        }

        // 6. CONFIRMATION OBLIGATOIRE pour TOUS les types (FV, FA, FT, etc.)
        // C'est la confirmation qui génère le Code DEF et le QR Code
        $confirmResult = $this->api->confirmInvoice($uid, $total, $vtotal);

        if (!$confirmResult['success']) {
            return [
                'success' => false,
                'error' => 'Erreur confirmation: ' . ($confirmResult['data']['errorDesc'] ?? $confirmResult['error'] ?? 'Erreur inconnue'),
                'httpCode' => $confirmResult['httpCode'],
                'uid' => $uid,
                'response' => $confirmResult['data'] ?? null
            ];
        }

        // 7. Extraire les données de la confirmation (Code DEF, QR, etc.)
        $confirmData = $confirmResult['data'] ?? [];

        // 8. Retourner tous les détails
        return [
            'success' => true,
            'uid' => $uid,
            'total' => $total,
            'vtotal' => $vtotal,
            'qrCode' => $confirmData['qrCode'] ?? '',
            'codeDEFDGI' => $confirmData['codeDEFDGI'] ?? '',
            'dateTime' => $confirmData['dateTime'] ?? date('Y-m-d H:i:s'),
            'counters' => $confirmData['counters'] ?? '',
            'nim' => $confirmData['nim'] ?? $this->emcfId,
            'nif' => $confirmData['nif'] ?? $this->nif
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
     * Note: Pour créer une FA, utilisez plutôt creer() avec type='FA'
     */
    public function annuler($uid)
    {
        return $this->api->cancelInvoice($uid);
    }
}
