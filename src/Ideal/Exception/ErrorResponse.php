<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ErrorResponse extends HttpException implements IdealExceptionInterface
{
}
