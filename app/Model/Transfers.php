<?php 

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class Transfers extends Model
{
    public string $keyType = 'string';

    public bool $incrementing = true;

    protected array $fillable = ['id', 'id_user_payer', 'id_user_payee', 'transfer_status', 'amount', 'created_at', 'updated_at'];

}
