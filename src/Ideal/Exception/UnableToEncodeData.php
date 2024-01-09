<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Exception;

use LogicException;

class UnableToEncodeData extends LogicException implements IdealExceptionInterface
{
}
