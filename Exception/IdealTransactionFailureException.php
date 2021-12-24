<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Exception;
use Lens\Bundle\IdealBundle\Response\AcquirerStatusRes;

class IdealTransactionFailureException extends IdealTransactionException
{
    public function __construct(
        AcquirerStatusRes $response,
        string $message = null,
        Exception $previous = null
    ) {
        parent::__construct(
            $response,
            $message ?? 'Payment failed due to technical issues at the buyer’s bank',
            $previous
        );
    }
}
