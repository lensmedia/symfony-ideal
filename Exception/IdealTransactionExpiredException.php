<?php

namespace Lens\Bundle\IdealBundle\Exception;

use Exception;
use Lens\Bundle\IdealBundle\Response\AcquirerStatusRes;

class IdealTransactionExpiredException extends IdealTransactionException
{
    public function __construct(
        AcquirerStatusRes $response,
        string $message = null,
        Exception $previous = null
    ) {
        parent::__construct(
            $response,
            $message ?? 'Payment not finished by buyer within expiration period',
            $previous
        );
    }
}
