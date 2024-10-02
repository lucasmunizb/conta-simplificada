<?php

namespace App\Entity;

use App\Model\Users;

class UserEntity
{
    private string $id;
    private string $name;
    private string $email;
    private string $userType;
    private string $password;
    private string $balance;

    public function __construct(Users $user) {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->userType = $user->userType;
        $this->password = $user->password;
        $this->balance = $user->balance;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserType(): string
    {
        return $this->userType;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getpassword(): string
    {
        return $this->password;
    }

    public function getbalance(): string
    {
        return $this->balance;
    }
        


}