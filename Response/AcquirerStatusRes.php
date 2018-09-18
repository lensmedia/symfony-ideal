<?php

namespace Lens\Bundle\IdealBundle\Response;

use DateTimeImmutable;

class AcquirerStatusRes extends IdealResponse
{
    public function acquirer(): string
    {
        return (string) $this->content->Acquirer->acquirerID;
    }

    public function transaction(): string
    {
        return (string) $this->content->Transaction->transactionID;
    }

    public function status(): string
    {
        return (string) $this->content->Transaction->status;
    }

    public function statusTimestamp(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->content->Transaction->statusDateTimestamp);
    }
}
