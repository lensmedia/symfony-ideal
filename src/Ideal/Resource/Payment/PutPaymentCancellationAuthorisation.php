<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource\Payment;

use Lens\Bundle\IdealBundle\Ideal\Resource\Resource;

class PutPaymentCancellationAuthorisation extends Resource
{
    public const URL = '/xs2a/routingservice/services/ob/pis/v3/payments/{paymentId}/cancellation-authorisations/{authorisationId}';
}
