<?php 

declare(strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class User extends Model
{
    public string $keyType = 'string';

    public bool $incrementing = false;

    protected array $fillable = ['id', 'id_user_payer', 'id_user_payee', 'transfer_status', 'amount', 'created_at', 'updated_at'];
}
