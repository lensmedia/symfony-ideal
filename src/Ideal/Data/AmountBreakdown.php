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

    public function __construct()
    {
        $this->shippingCost = BigDecimal::zero();
    }

    public function setOrderAmount(BigDecimal|string $orderAmount): void
    {
        $this->orderAmount = BigDecimal::of($orderAmount);
    }

    public function setShippingCost(BigDecimal|string|null $shippingCost= null): void
    {
        $this->shippingCost = BigDecimal::of($shippingCost ?? '0');
    }

    public function jsonSerialize(): array
    {
        return [
            'OrderAmount' => Util::moneyToString($this->orderAmount),
            'ShippingCost' => Util::moneyToString($this->shippingCost),
        ];
    }
}
