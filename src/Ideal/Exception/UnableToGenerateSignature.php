<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Exception;

use RuntimeException;

class UnableToGenerateSignature extends RuntimeException implements IdealExceptionInterface
{
}
