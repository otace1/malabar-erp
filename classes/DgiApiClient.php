<?php

/**
 * Classe pour gérer les appels API e-MCF - DGI RDC
 */
class DgiApiClient
{

    private $baseUrl;
    private $token;

    public function __construct($baseUrl, $token)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
    }

    /**
     * Effectue une requête HTTP vers l'API
     */
    private function makeRequest($method, $endpoint, $data = null)
    {
        $url = $this->baseUrl . $endpoint;

        // LOG: Requête
        error_log("\n=== REQUÊTE API DGI ===");
        error_log("Méthode: $method");
        error_log("URL: $url");
        if ($data) {
            error_log("Données envoyées: " . json_encode($data, JSON_PRETTY_PRINT));
        }

        $ch = curl_init($url);

        $headers = [
            "Authorization: Bearer " . $this->token,
            "Content-Type: application/json; charset=utf-8",
            "Accept: application/json"
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Pour environnement de dev
        curl_setopt($ch, CURLOPT_ENCODING, ''); // Support compression

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            error_log("JSON envoyé (POST): " . $jsonData);
        } elseif ($method === 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            if ($data) {
                $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                error_log("JSON envoyé (PUT): " . $jsonData);
            }
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // LOG: Réponse
        error_log("Code HTTP: $httpCode");
        error_log("Réponse brute: " . substr($response, 0, 500));

        if ($error) {
            error_log("ERREUR CURL: $error");
            return [
                'success' => false,
                'error' => 'Erreur CURL: ' . $error,
                'httpCode' => $httpCode,
                'rawResponse' => $response
            ];
        }

        $result = json_decode($response, true);

        if ($httpCode < 200 || $httpCode >= 300) {
            error_log("ERREUR HTTP: " . json_encode($result, JSON_PRETTY_PRINT));
        }

        return [
            'success' => ($httpCode >= 200 && $httpCode < 300),
            'httpCode' => $httpCode,
            'data' => $result,
            'rawResponse' => $response
        ];
    }

    /**
     * Vérifier le statut de l'API
     */
    public function checkStatus()
    {
        return $this->makeRequest('GET', '/info/status');
    }

    /**
     * Obtenir les groupes de taxes
     */
    public function getTaxGroups()
    {
        return $this->makeRequest('GET', '/info/taxGroups');
    }

    /**
     * Obtenir les types de factures
     */
    public function getInvoiceTypes()
    {
        return $this->makeRequest('GET', '/info/invoiceTypes');
    }

    /**
     * Obtenir les types de paiement
     */
    public function getPaymentTypes()
    {
        return $this->makeRequest('GET', '/info/paymentTypes');
    }

    /**
     * Créer une nouvelle facture
     */
    public function createInvoice($invoiceData)
    {
        return $this->makeRequest('POST', '/invoice', $invoiceData);
    }

    /**
     * Confirmer une facture (obtenir le QR Code)
     */
    public function confirmInvoice($uid, $total, $vtotal)
    {
        $data = [
            'total' => $total,
            'vtotal' => $vtotal
        ];
        return $this->makeRequest('PUT', "/invoice/{$uid}/confirm", $data);
    }

    /**
     * Annuler une facture
     */
    public function cancelInvoice($uid)
    {
        return $this->makeRequest('PUT', "/invoice/{$uid}/cancel");
    }

    /**
     * Obtenir les détails d'une facture
     */
    public function getInvoice($uid)
    {
        return $this->makeRequest('GET', "/invoice/{$uid}");
    }

    /**
     * Obtenir la liste des factures en attente
     */
    public function getPendingInvoices()
    {
        return $this->makeRequest('GET', '/invoice');
    }
}
