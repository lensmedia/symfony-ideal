<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Util;

class DebtorContactDetailsRequestData implements SerializableRequestData
{
    /**
     * Request to provide the first name of the debtor.
     *
     * Default: false
     */
    public ?bool $firstName = null;

    /**
     * Request to provide the last name of the debtor.
     *
     * Default: false
     */
    public ?bool $lastName = null;

    /**
     * Request to provide the phone number of the debtor in E.164 format.
     *
     * Default: false
     */
    public ?bool $phoneNumber = null;

    /**
     * Request to provide the e-mail address of the debtor.
     *
     * Default: false
     */
    public ?bool $email = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'FirstName' => $this->firstName,
            'LastName' => $this->lastName,
            'PhoneNumber' => $this->phoneNumber,
            'Email' => $this->email,
        ], Util::isNotNull(...));
    }
}
