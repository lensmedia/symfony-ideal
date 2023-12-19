<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

/**
 * Credentials Details.
 */
class CredentialDetails
{
    /**
     * Binary identification of the transparency of the provided credentials by the PSU. Can have 2 values,
     * - true
     * - false
     *
     * Can be provided by ASPSP. If not provided by the ASPSP then by default,
     * - true, if the CredentialId=ewl-password
     * - false, if CredentialId=ewl-user-id
     */
    public ?bool $isSecret = null;

    /**
     * Credential detail identification of the PSU credential at the bank (provided bi CBI if approach is Embedded). If not provided by the ASPSP, then default values should be,
     *
     * - ewl-user-id, when IsSecret=false
     * - ewl-password, when IsSecret=true
     */
    public string $credentialId;

    /**
     * The list of the labels to show to the PSU. They are internationalized.
     *
     * @var CredentialLabel[]
     */
    public array $labelList = [];
}
