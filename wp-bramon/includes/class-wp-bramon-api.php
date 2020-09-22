<?php

class Wp_Bramon_Api {
    private $apiKey;

    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    public function get_stations() {
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.bramonmeteor.org/v1/admin/stations?limit=1000");
            curl_setopt($curl, CURLOPT_USERAGENT,'WP_Bramon');
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $this->apiKey]);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

            $response = curl_exec($curl);

            curl_close($curl);

            if (!$response) {
                throw new Exception('Erro conectando com a API.');
            }

            $estacoes = json_decode($response, true);

            return $estacoes['data'];
        } catch (Exception $e) {
            return [];
        }
    }

    public function get_captures(array $filter = []) {
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://api.bramonmeteor.org/v1/admin/captures");
            curl_setopt($curl, CURLOPT_USERAGENT,'WP_Bramon');
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $this->apiKey]);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

            $response = curl_exec($curl);

            curl_close($curl);

            if (!$response) {
                throw new Exception('Erro conectando com a API.');
            }

            return json_decode($response, true);
        } catch (Exception $e) {
            return [];
        }
    }
}
