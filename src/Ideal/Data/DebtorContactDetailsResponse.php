<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

class DebtorContactDetailsResponse
{
    /**
     * The first name of the debtor.
     */
    public ?string $firstName = null;

    /**
     * The last name of the debtor.
     */
    public ?string $lastName = null;

    /**
     * The phone number of the debtor in E.164 format.
     *
     * Pattern: ^\+[1-9][0-9]{1,14}$
     * Example: +31612345678
     */
    public ?string $phoneNumber = null;

    /**
     * The e-mail address of the debtor.
     */
    public ?string $email = null;
}
