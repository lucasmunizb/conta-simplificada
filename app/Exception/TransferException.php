<?php

namespace App\Exception;

use Throwable;
use Hyperf\DbConnection\Db;


class TransferException extends \Exception
{
    public function __construct($message = "Erro durante a transferência", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        DB::rollBack();
    }
}