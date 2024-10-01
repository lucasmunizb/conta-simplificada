<?php

namespace App\Service;

class TransferService
{
    public function handleTransfer($payerId, $payeeId, $amount)
    {
        return [
            'data' => [
                $payerId,
                $payeeId,
                $amount
            ]
        ];
    }
}