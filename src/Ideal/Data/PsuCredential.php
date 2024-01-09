<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

/**
 * PSU Credentials on the Bank system.
 */
class PsuCredential
{
    /**
     * Product Identification. Used to contextualize the credentials provided by the PSU for those ASPSP that need of
     * it.
     */
    public ?string $aspspProductCode = null;

    /**
     * Credentials Details.
     */
    public ?CredentialDetails $credentialsDetails = null;
}
