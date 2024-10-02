<?php

namespace App\Service;

use GuzzleHttp\Client;

class EmailService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function sendEmail($contaId, $valor)
    {
        $response = $this->client->post('https://util.devi.tools/api/v1/notify', [
            'json' => [
                'contaId' => $contaId,
                'valor' => $valor,
            ]
        ]);
        return json_decode($response->getBody(), true);
    }
}

