<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource\Preference;

use Lens\Bundle\IdealBundle\Ideal\Resource\Resource;

class GetPreference extends Resource
{
    public const URL = '/xs2a/routingservice/services/ob/pis/v3/preferences/{Psuid}';
}
