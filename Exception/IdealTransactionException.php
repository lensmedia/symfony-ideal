<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Exception;
use Lens\Bundle\IdealBundle\Response\AcquirerStatusRes;

abstract class IdealTransactionException extends IdealException
{
    const TRANSACTION_OPEN = 0;
    const TRANSACTION_SUCCESS = 1;
    const TRANSACTION_CANCELLED = 2;
    const TRANSACTION_EXPIRED = 3;
    const TRANSACTION_FAILURE = 4;

    public function __construct(
        private AcquirerStatusRes $response,
        string $message = null,
        int $code = 0,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getResponse(): AcquirerStatusRes
    {
        return $this->response;
    }
}
