<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource\ScheduledPayment;

use Lens\Bundle\IdealBundle\Ideal\Resource\Resource;

class GetScheduledPaymentStatus extends Resource
{
    public const URL = '/xs2a/routingservice/services/ob/pis/v3/scheduled-payments/{paymentId}/status';
}
