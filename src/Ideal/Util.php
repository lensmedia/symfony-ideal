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
    public static function enumToString(mixed $enum): string|array|null
    {
        if ($enum === null) {
            return null;
        }

        if (is_array($enum)) {
            return array_map(
                static fn ($enum) => Util::enumToString($enum),
                $enum,
            );
        }

        return $enum->value;
    }

    public static function moneyToString(Money|BigDecimal|array|null $money): string|array|null
    {
        if ($money === null) {
            return null;
        }

        if (is_array($money)) {
            return array_map(
                static fn ($money) => Util::moneyToString($money),
                $money,
            );
        }

        if ($money instanceof Money) {
            $money = $money->getAmount();
        }

        return (string)$money->toScale(2, RoundingMode::HALF_UP);
    }

    public static function currencyToString(Money|Currency|array|null $currency): string|array|null
    {
        if ($currency === null) {
            return null;
        }

        if (is_array($currency)) {
            return array_map(
                static fn ($currency) => Util::currencyToString($currency),
                $currency,
            );
        }

        if ($currency instanceof Money) {
            $currency = $currency->getCurrency();
        }

        return $currency->getCurrencyCode();
    }

    public static function dateToString(DateTimeInterface $timestamp): string
    {
        return $timestamp->format('Y-m-d');
    }

    public static function dateTimeToString(DateTimeInterface $timestamp): string
    {
        return $timestamp->format('c');
    }

    public static function isNotNull(mixed $value): bool
    {
        return $value !== null;
    }
}
