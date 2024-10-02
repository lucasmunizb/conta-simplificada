<?php 

declare(strict_types=1);

namespace App\Model;

use App\Entity\UserEntity;
use Hyperf\DbConnection\Model\Model;

class Users extends Model
{
    public string $keyType = 'string';

    public bool $incrementing = true;

    protected array $fillable = ['id', 'name', 'document', 'email', 'password', 'user_type', 'balance'];

}
