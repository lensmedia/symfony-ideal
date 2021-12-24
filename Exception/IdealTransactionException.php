<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Exception;
use Lens\Bundle\IdealBundle\Response\AcquirerStatusRes;

abstract class IdealTransactionException extends IdealException
{
    public function __construct(
        private AcquirerStatusRes $response,
        string $message = null,
        Exception $previous = null
    ) {
        parent::__construct($message, 0, $previous);
    }

    public function getResponse(): AcquirerStatusRes
    {
        return $this->response;
    }
}
