<?php

namespace App\Services;
use GuzzleHttp\Client;

class ApiService
{
    private $url;

    function __construct()
    {
        $this->url = env('BASE_URL_API');
    }

    public function requestResource($method, $endpoint, $data = null, $headers = [])
    {
        $defaultHeaders = [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];

        $headers = array_merge($defaultHeaders, $headers);

        $client = new Client([
            'base_uri' => $this->url,
            'verify'   => false,
        ]);

        try {
            $options = [
                'headers' => $headers,
            ];

            // Jangan kirim body JSON jika tidak ada data
            if ($data !== null) {
                $options['json'] = $data;
            }

            $response = $client->request($method, $endpoint, $options);

            return [
                'status' => $response->getStatusCode(),
                'body'   => json_decode($response->getBody()->getContents(), true),
            ];

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return [
                'status' => $e->getResponse()->getStatusCode(),
                'body'   => json_decode(
                    $e->getResponse()->getBody()->getContents(),
                    true
                ),
            ];
        }
    }

}
