<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource\BulkPayment;

use Lens\Bundle\IdealBundle\Ideal\Resource\Resource;

class PostBulkPaymentCancellationIdentification extends Resource
{
    public const URL = '/xs2a/routingservice/services/ob/pis/v3/bulk-payments/{paymentId}/cancellation-identification';
}
