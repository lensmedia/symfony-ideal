<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource\Refund;

use Lens\Bundle\IdealBundle\Ideal\Resource\Resource;

class PostRefundAuthorisation extends Resource
{
    public const URL = '/xs2a/routingservice/services/ob/pis/v3/refunds/{refundId}/authorisations';
}
