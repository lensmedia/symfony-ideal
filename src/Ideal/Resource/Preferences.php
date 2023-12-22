<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Exception\NotImplemented;
use Lens\Bundle\IdealBundle\Ideal\IdealInterface;

readonly class Preferences extends Resource
{
    private const BASE_URL = '/xs2a/routingservice/services/ob/pis/'.IdealInterface::VERSION.'/preferences';

    /**
     * Get PSU preferred bank and preferred account.
     */
    public function get(string $psuId): void
    {
        //POST /{Psuid}

        throw new NotImplemented(__METHOD__);
    }
}
