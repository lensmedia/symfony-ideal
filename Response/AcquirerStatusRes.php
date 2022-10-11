<?php

namespace Lens\Bundle\IdealBundle\Response;

use DateTimeImmutable;

class AcquirerStatusRes extends IdealResponse
{
    public function acquirer(): string
    {
        return (string)$this->content->Acquirer->acquirerID;
    }

    public function transaction(): string
    {
        return (string)$this->content->Transaction->transactionID;
    }

    public function status(): string
    {
        return (string)$this->content->Transaction->status;
    }

    public function statusTimestamp(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->content->Transaction->statusDateTimestamp);
    }

    public function consumerName(): string
    {
        return (string)$this->content->Transaction->consumerName;
    }
    public function consumerIban(): string
    {
        return (string)$this->content->Transaction->consumerIBAN;
    }

    public function consumerBic(): string
    {
        return (string)$this->content->Transaction->consumerBIC;
    }

    public function amount(): string
    {
        return (string)$this->content->Transaction->amount;
    }

    public function currency(): string
    {
        return (string)$this->content->Transaction->currency;
    }
}
