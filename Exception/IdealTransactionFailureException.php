<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Exception;
use Lens\Bundle\IdealBundle\Response\AcquirerStatusRes;

class IdealTransactionFailureException extends IdealTransactionException
{
    public function __construct(
        AcquirerStatusRes $response,
        string $message = null,
        int $code = 0,
        Exception $previous = null
    ) {
        parent::__construct(
            $response,
            'Payment failed due to technical issues at the buyer’s bank',
            self::TRANSACTION_FAILURE,
            $previous
        );
    }
}
