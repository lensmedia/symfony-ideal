<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Brick\Money\Currency;
use Brick\Money\Money;
use DateTimeInterface;

class Util
{
    public static function EnumToString(mixed $enum): ?string
    {
        return $enum?->value;
    }

    public static function MoneyToString(Money|BigDecimal|null $money): ?string
    {
        if ($money === null) {
            return null;
        }

        if ($money instanceof Money) {
            $money = $money->getAmount();
        }

        return (string)$money->toScale(2, RoundingMode::HALF_UP);
    }

    public static function CurrencyToString(Money|Currency|null $currency): ?string
    {
        if ($currency === null) {
            return null;
        }

        if ($currency instanceof Money) {
            $currency = $currency->getCurrency();
        }

        return $currency->getCurrencyCode();
    }

    public static function DateToString(DateTimeInterface $timestamp): string
    {
        return $timestamp->format('Y-m-d');
    }

    public static function DateTimeToString(DateTimeInterface $timestamp): string
    {
        return $timestamp->format('c');
    }
}
