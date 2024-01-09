<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Exception;

use RuntimeException;
use Throwable;

class CurrencyMismatch extends RuntimeException implements IdealExceptionInterface
{
    public function __construct(
        string $currencyA,
        string $currencyB,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct(sprintf(
            'Currency mismatch: %s and %s',
            $currencyA,
            $currencyB,
        ), $code, $previous);
    }
}
