<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Brick\Math\BigDecimal;
use Brick\Money\Currency;
use Brick\Money\Money;

trait MoneyTrait
{
    /**
     * A code allocated to a currency by a Maintenance Agency under an international identification scheme, as
     * described in the latest edition of the international standard ISO 4217 "Codes for the representation of
     * currencies and funds".
     */
    public Currency $currency;

    /**
     * Amount of the fees.
     */
    public BigDecimal $amount;

    public function asMoney(): Money
    {
        return Money::of($this->amount, $this->currency);
    }
}
