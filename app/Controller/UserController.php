<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\UserService;
use App\Model\Users;

class UserController extends AbstractController
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUser(int $id)
    {
        $user = $this->userService->getUserFromCache($id);
        
        if ($user) {
            return $user;
        }
        $this->storeUser($id);
        return $this->userService->getInfoById($id)->toArray();
    }

    public function storeUser(int $id)
    {
        $this->userService->storeUserInCache($id);

        return ['status' => 'success', 'message' => 'User stored in cache'];
    }

    public function checkBalance(Users $user)
    {
        return $this->getUser((int) $user->id)['balance'];
    }

    public function verifyUserBalanceTransfer(int $id, float $amount)
    {
        $user = $this->userService->getInfoById($id);
        $balance = $this->checkBalance($user);
        return $balance >= $amount;
    }

}