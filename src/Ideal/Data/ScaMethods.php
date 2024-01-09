<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Data\Type\AuthenticationType;
use Symfony\Component\Validator\Constraints as Assert;

class ScaMethods
{
    /**
     * Type of the SCA authentication method.
     */
    public AuthenticationType $authenticationType;

    /**
     * ID of the authentication method. Used in subsequent API calls to refer to the authentication method.
     */
    #[Assert\NotBlank]
    public string $authenticationMethodId;

    /**
     * Version of the method.
     */
    #[Assert\Length(min: 1)]
    public ?string $version;

    /**
     * Name of the method in readable form. This name shall be used by the TPP when presenting a list of authentication
     * methods to the PSU, if available.
     */
    #[Assert\Length(min: 1)]
    public ?string $name;

    /**
     * Detailed information about the SCA method, meant for the PSU.
     */
    #[Assert\Length(min: 1)]
    public ?string $explanation;
}
