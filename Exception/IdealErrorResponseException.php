<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Exception;
use Lens\Bundle\IdealBundle\Response\AcquirerErrorRes;

class IdealErrorResponseException extends Exception
{
    private $error;

    public function __construct(AcquirerErrorRes $error)
    {
        parent::__construct($error->consumerMessage(), 0);

        $this->error = $error;
    }

    public function getError(): AcquirerErrorRes
    {
        return $this->error;
    }

    public function getErrorCode(): string
    {
        return $this->error->errorCode();
    }

    public function getErrorDescription(): string
    {
        return AcquirerErrorRes::ERROR_DESCRIPTIONS[$this->error->errorCode()];
    }

    public function __toString()
    {
        return $this->error->consumerMessage();
    }
}
