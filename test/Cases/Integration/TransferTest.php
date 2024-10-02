<?php

declare(strict_types=1);

namespace HyperfTest\Cases\Integration;

use HyperfTest\HttpTestCase;

class TransferTest extends HttpTestCase
{
    public function testTransferSuccess()
    {
        $payload = [
            'payer' => 1,
            'payee' => 2,
            'amount' => 100.00,
        ];

        $response = $this->post('/api/v1/transfer', $payload);

        $this->assertSame(200, $response->getStatusCode());
        
        $responseData = json_decode((string)$response->getBody()->getContents(), true);
        $this->assertEquals('Transfer successful', $responseData['message']);
    }

    public function testTransferFailureDueToInsufficientFunds()
    {
        $payload = [
            'payer' => 1,
            'payee' => 2,
            'amount' => 1000.00, 
        ];

        $response = $this->post('/api/v1/transfer', $payload);

        $this->assertSame(402, $response->getStatusCode());

        $responseData = json_decode((string)$response->getBody()->getContents(), true);
        $this->assertEquals('Transaction declined due to insufficient funds.', $responseData['error']);
    }

    public function testTransferFailureDueToInvalidPayer()
    {
        $payload = [
            'payer' => 9999, 
            'payee' => 2,
            'amount' => 100.00,
        ];

        $response = $this->post('/api/v1/transfer', $payload);

        $this->assertSame(400, $response->getStatusCode());

        $responseData = json_decode((string)$response->getBody()->getContents(), true);
        $this->assertEquals('Invalid payer.', $responseData['error']);
    }
}
