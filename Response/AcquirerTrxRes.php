<?php

namespace Lens\Bundle\IdealBundle\Response;

use DateTimeImmutable;

final class AcquirerTrxRes extends IdealResponse
{
    /**
     * Acquirer ID from server (4 digit integer return as string).
     *
     * @return string
     */
    public function acquirer(): string
    {
        return (string) $this->content->Acquirer->acquirerID;
    }

    /**
     * Target URL for the actual transaction handeling (redirect to selected bank).
     *
     * @return string
     */
    public function url(): string
    {
        return (string) $this->content->Issuer->issuerAuthenticationURL;
    }

    public function transaction(): string
    {
        return (string) $this->content->Transaction->transactionID;
    }

    public function purchase(): string
    {
        return (string) $this->content->Transaction->purchaseID;
    }

    public function transactionTimestamp(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->content->Transaction->transactionCreateDateTimestamp);
    }
}
