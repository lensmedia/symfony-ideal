<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Lens\Bundle\IdealBundle\Response\AcquirerErrorRes;

class IdealErrorResponseException extends IdealException
{
    public function __construct(private AcquirerErrorRes $error)
    {
        parent::__construct(sprintf(
            '[%s] %s - %s',
            $error->errorCode(),
            $error->errorMessage(),
            $error->errorDetail(),
        ));
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

    public function getConsumerMessage(): string
    {
        return $this->error->consumerMessage();
    }

    public function __toString(): string
    {
        return $this->error->consumerMessage();
    }
}
