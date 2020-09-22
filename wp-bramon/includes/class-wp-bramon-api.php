<?php

/**
 * Class Wp_Bramon_Api
 *
 * BRAMON API Client
 *
 * @author Thiago Paes <thiago@bramonmeteor.org>
 */
class Wp_Bramon_Api {
    const API_BASE = 'https://api.bramonmeteor.org/v1/';

    /**
     * The API key
     * @var string
     */
    private $apiKey;

    /**
     * Wp_Bramon_Api constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey) {
        $this->apiKey = $apiKey;
    }

    /**
     * Get the stations
     * @return array|mixed
     */
    public function get_stations() {
        try {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, self::API_BASE . "operator/stations?limit=1000");
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

    /**
     * Get the captures
     * @param array $filter
     * @param int $page
     * @return array|mixed
     */
    public function get_captures(array $filter = [], int $page = 1) {
        try {
            $filters = http_build_query($filter);

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, self::API_BASE . "operator/captures?page={$page}&{$filters}");
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_USERAGENT,'WP_Bramon');
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $this->apiKey]);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 400);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($curl, CURLOPT_ENCODING, '');

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
