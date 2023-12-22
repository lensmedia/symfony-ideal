<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Brick\Math\BigDecimal;
use Brick\Money\Currency;
use Brick\Money\Money;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\AmountType;
use Lens\Bundle\IdealBundle\Ideal\Exception\CurrencyMismatch;
use Lens\Bundle\IdealBundle\Ideal\Exception\InvalidArgument;
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
    public BigDecimal $amount;

    /**
     * Conditionally used for amount type Change or Define. The value in case of Change should be less than or equal to
     * the amount. In case of Fixed, this value will be ignored.
     *
     * Pattern: ^\d{1,13}\.\d{1,5}$
     *
     * @example 123.45
     */
    public ?BigDecimal $minimumAmount = null;

    /**
     * Conditionally used for amount type Change or Define. The value in case of Change should be greater than or equal
     * to the amount value. In case of Fixed, this value will be ignored.
     *
     * Pattern: ^\d{1,13}\.\d{1,5}$
     *
     * @example 123.45
     */
    public ?BigDecimal $maximumAmount = null;

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

    public static function create(
        Money|BigDecimal|string $amount,
        ?AmountType $type = null,
        BigDecimal|string|null $minimumAmount = null,
        BigDecimal|string|null $maximumAmount = null,
        Currency|string|null $currency = null,
    ): self {
        if (!($amount instanceof Money) && $currency === null) {
            throw new InvalidArgument('Currency must be provided when amount is not a Money object');
        }

        if ($currency && $amount instanceof Money && $currency !== (string)$amount->getCurrency()) {
            throw new CurrencyMismatch((string)$currency, (string)$amount->getCurrency());
        }

        $instance = new self();
        $instance->type = $type;
        $instance->setAmount($amount);
        if ($minimumAmount) { $instance->setMinimumAmount($minimumAmount); }
        if ($maximumAmount) { $instance->setMaximumAmount($maximumAmount); }
        if ($currency) { $instance->setCurrency($currency); }

        return $instance;
    }

    public function setAmount(Money|BigDecimal|string $amount): void
    {
        if ($amount instanceof Money) {
            $this->amount = $amount->getAmount();
            $this->currency = $amount->getCurrency();
        } elseif (is_string($amount)) {
            $this->amount = BigDecimal::of($amount);
        } else {
            $this->amount = $amount;
        }
    }

    public function setMinimumAmount(BigDecimal|string|null $minimumAmount): void
    {
        $this->minimumAmount = (null === $minimumAmount)
            ? null
            : BigDecimal::of($minimumAmount);
    }

    public function setMaximumAmount(BigDecimal|string|null $maximumAmount): void
    {
        $this->maximumAmount = (null === $maximumAmount)
            ? null
            : BigDecimal::of($maximumAmount);
    }

    public function setCurrency(Currency|string|null $currency): void
    {
        $this->currency = (null === $currency)
            ? null
            : Currency::of($currency);
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'Type' => Util::enumToString($this->type),
            'Amount' => Util::moneyToString($this->amount),
            'MinimumAmount' => Util::moneyToString($this->minimumAmount),
            'MaximumAmount' => Util::moneyToString($this->maximumAmount),
            'Currency' => Util::currencyToString($this->currency),
            'AmountBreakdown' => $this->amountBreakdown,
        ], Util::isNotNull(...));
    }
}
