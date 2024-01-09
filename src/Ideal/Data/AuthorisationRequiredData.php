<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

/**
 * The data required for PSU authentication and transaction authorisation.
 */
class AuthorisationRequiredData
{
    /**
     * List of credentials the PSU has on the ASPSP's system. The PSU has to provide the CredentialValue for each of these (Username & Password).
     *
     * @var PsuCredential[]
     */
    public ?array $psuCredentials = null;

    /**
     * Array of available ScaMethods.
     *
     * @var ScaMethods[]
     */
    public ?array $scaMethods = null;

    /**
     * The ScaMethod chosen by the PSU.
     */
    public ?ScaMethods $chosenScaMethod = null;

    /**
     * JSON DTO used to represent challenge data.
     */
    public ?ScaChallengeData $challengeData = null;
}
