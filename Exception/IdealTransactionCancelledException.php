<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Exception;
use Lens\Bundle\IdealBundle\Response\AcquirerStatusRes;

class IdealTransactionCancelledException extends IdealTransactionException
{
    public function __construct(
        AcquirerStatusRes $response,
        string $message = null,
        int $code = 0,
        Exception $previous = null
    ) {
        parent::__construct(
            $response,
            'Payment cancelled by buyer',
            self::TRANSACTION_CANCELLED,
            $previous
        );
    }
}
