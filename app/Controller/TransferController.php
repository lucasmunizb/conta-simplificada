<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\TransferRequest;
use Hyperf\HttpServer\Contract\ResponseInterface as Response;
use App\Service\TransferService;

class TransferController extends AbstractController
{
    private $transferService;

    public function __construct(TransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function transfer(TransferRequest $request, Response $response)
    {
        $validated = $request->validated();

        $result = $this->transferService->handleTransfer($validated['payer'], $validated['payee'], $validated['amount']);

        return $response->json([
            'message' => 'Transferência realizada com sucesso',
            'data' => $result['data']
        ]);
    }

}   