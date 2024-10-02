<?php

namespace App\Repository;

use App\Model\Transfers;

class TransferRepository
{
    public function __construct(){}

    public static function findById(string $id) : Transfers
    {
        return Transfers::find($id);
    }

    public static function initializeTransfer(int $idPayer, int $idPayee, float $amount) : Transfers
    {
        $transfer = new Transfers();
        $transfer->save([
            'id_user_payer' => $idPayer,
            'id_user_payee' => $idPayee,
            'transfer_status' => 'requested',
            'amount' => $amount
        ]);

        return $transfer;
    }

    public static function updateTransfer(int $idTransfer, string $transfer_status)
    {
        $transfer = self::findById($idTransfer);
        $transfer->update([
            'transfer_status' => $transfer_status
        ]);

        return $transfer;
    }

}