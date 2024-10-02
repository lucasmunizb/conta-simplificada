<?php

namespace App\Service;

use App\Controller\UserController;
use GuzzleHttp\Client;
use App\Exception;
use App\Repository\TransferRepository;
use App\Service\AuthorizationTransferService;
use App\Service\EmailService;
use Hyperf\DbConnection\Db;
use Hyperf\Context\ApplicationContext;

class TransferService
{
    protected $emailService;
    protected $httpClient;
    private $userController;
    private $authorizationTransfer;
    
    public function __construct()
    {
        $this->httpClient = new Client();
        $container = ApplicationContext::getContainer();
        $this->userController = new UserController($container->get(UserService::class));
        $this->authorizationTransfer = new AuthorizationTransferService();
        $this->emailService = new EmailService();
    }

    public function handleTransfer($payerId, $payeeId, $amount) : Array
    {
        if (!$this->userController->verifyUserBalanceTransfer((int) $payerId, $amount)) throw new Exception\TransferException("User's balance is lower to amount transfer", 402);
        if (!$this->userController->verifyUserCanSendTransfer((int) $payerId, $amount)) throw new Exception\TransferException("User can't send transfer, because your type is business", 402);

        DB::beginTransaction();

        $transfer = TransferRepository::initializeTransfer((int) $payerId, (int) $payeeId, $amount);
        $this->userController->withdral((int) $payerId, $amount);

        if (!$this->authorizationTransfer->verifyTransferAuthorization()) throw new Exception\TransferException("Transfer not authorized", 400);

        $this->userController->deposit((int) $payeeId, $amount);

        TransferRepository::updateTransfer($transfer->id, 'approved');

        $this->emailService->sendEmail($payeeId, $amount);

        DB::commit();

        return [
            'data' => [
                $payerId,
                $payeeId,
                $amount
            ]
        ];
    }
}