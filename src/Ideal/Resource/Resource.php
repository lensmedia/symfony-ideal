<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Exception\NotImplemented;

abstract class Resource implements ResourceInterface
{
    public function __construct()
    {
        throw new NotImplemented('Resource "'.static::class.'" is not implemented.');
    }
}
