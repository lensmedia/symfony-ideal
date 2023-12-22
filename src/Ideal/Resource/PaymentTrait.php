<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Data\PaymentDetailedInformation;

trait PaymentTrait
{
    public function mapPaymentNotificationData(
        string $content,
        array $headers = [],
    ): PaymentDetailedInformation {
        return $this->map($content, PaymentDetailedInformation::class);
    }
}
