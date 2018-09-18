<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Exception;
use Lens\Bundle\IdealBundle\Response\AcquirerStatusRes;

class IdealTransactionOpenException extends IdealTransactionException
{
    public function __construct(
        AcquirerStatusRes $response,
        string $message = null,
        int $code = 0,
        Exception $previous = null
    ) {
        parent::__construct(
            $response,
            'Final status not yet known, try again later',
            self::TRANSACTION_OPEN,
            $previous
        );
    }
}
