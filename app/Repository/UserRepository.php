<?php

namespace App\Repository;

use App\Model\Users;

class UserRepository
{
    public Users $userModel;

    public function __construct(){}

    public static function findById(string $id) : Users
    {
        return Users::find($id);
    }
}