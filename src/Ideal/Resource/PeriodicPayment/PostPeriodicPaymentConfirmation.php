<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource\PeriodicPayment;

use Lens\Bundle\IdealBundle\Ideal\Resource\Resource;

class PostPeriodicPaymentConfirmation extends Resource
{
    public const URL = '/xs2a/routingservice/services/ob/pis/v3/periodic-payments/{paymentId}/confirmation';
}
