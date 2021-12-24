<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Exception;
use Lens\Bundle\IdealBundle\Response\AcquirerStatusRes;

class IdealTransactionOpenException extends IdealTransactionException
{
    public function __construct(
        AcquirerStatusRes $response,
        string $message = null,
        Exception $previous = null
    ) {
        parent::__construct(
            $response,
            $message ?? 'Final status not yet known, try again later',
            $previous
        );
    }
}
