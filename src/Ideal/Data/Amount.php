<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Brick\Money\Currency;
use Brick\Money\Money;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\AmountType;
use Lens\Bundle\IdealBundle\Ideal\Util;
use Symfony\Component\Validator\Constraints as Assert;

class Amount implements SerializableRequestData
{
    /**
     * Amount type (Fixed, Change, Define)
     *
     * Defaults to Fixed.
     *
     * @see AmountType for definitions
     */
    public ?AmountType $type = null;

    /**
     * Amount of the payment. The decimal separator is a dot.
     *
     * Pattern: ^\d{1,13}\.\d{1,5}$
     *
     * @example 123.45
     */
    #[Assert\NotBlank]
    public Money $amount;

    /**
     * Conditionally used for amount type Change or Define. The value in case of Change should be less than or equal to
     * the amount. In case of Fixed, this value will be ignored.
     *
     * Pattern: ^\d{1,13}\.\d{1,5}$
     *
     * @example 123.45
     */
    public ?Money $minimumAmount = null;

    /**
     * Conditionally used for amount type Change or Define. The value in case of Change should be greater than or equal
     * to the amount value. In case of Fixed, this value will be ignored.
     *
     * Pattern: ^\d{1,13}\.\d{1,5}$
     *
     * @example 123.45
     */
    public ?Money $maximumAmount = null;

    /**
     * Currency of the payment. ISO 4217 currency codes should be used. For iDEAL only EUR is possible.
     *
     * Pattern: [A-Z]{3,3}
     * Defaults to EUR.
     *
     * @example EUR
     */
    public ?Currency $currency = null;

    /**
     *
     * Breakdown of the transaction amount. The sum of all the fields within this breakdown must be equal to the
     * transaction amount. Possible to use for iDEAL payments, only in the FastCheckout flow.
     */
    public ?AmountBreakdown $amountBreakdown = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'Type' => Util::EnumToString($this->type),
            'Amount' => Util::MoneyToString($this->amount),
            'MinimumAmount' => Util::MoneyToString($this->minimumAmount),
            'MaximumAmount' => Util::MoneyToString($this->maximumAmount),
            'Currency' => Util::CurrencyToString($this->currency),
            'AmountBreakdown' => $this->amountBreakdown,
        ], 'is_null');
    }
}
