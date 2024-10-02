<?php

namespace App\Service;

use GuzzleHttp\Client;

class AuthorizationTransferService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function verifyTransferAuthorization()
    {
        $response = $this->client->get('https://util.devi.tools/api/v2/authorize');
        return json_decode($response->getBody(), true)['data']['authorization'];
    }
}

