<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Brick\Math\BigDecimal;
use Lens\Bundle\IdealBundle\Ideal\Util;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Breakdown of the transaction amount. The sum of all the fields within this breakdown must be equal to the
 * transaction amount. Possible to use for iDEAL payments, only in the FastCheckout flow.
 */
class AmountBreakdown implements SerializableRequestData
{
    /**
     * Order amount. Possible to use for iDEAL payments, only in the fast-checkout flow.
     *
     * Pattern: ^\d{1,13}\.\d{1,5}$
     *
     * @example 123.45
     */
    #[Assert\NotBlank]
    public BigDecimal $orderAmount;

    /**
     * Shipping cost. Possible to use for iDEAL payments, only in the fast-checkout flow.
     *
     * Pattern: ^\d{1,13}\.\d{1,5}$
     *
     * @example 123.45
     */
    #[Assert\NotBlank]
    public BigDecimal $shippingCost;

    public function __construct(
        BigDecimal $orderAmount,
        ?BigDecimal $shippingCost = null,
    ) {
        $this->orderAmount = $orderAmount;
        $this->shippingCost = $shippingCost ?? BigDecimal::zero();
    }

    public function jsonSerialize(): array
    {
        return [
            'OrderAmount' => Util::moneyToString($this->orderAmount),
            'ShippingCost' => Util::moneyToString($this->shippingCost),
        ];
    }
}
