<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Symfony\Component\Validator\Constraints as Assert;

class RemittanceInformationStructured implements SerializableRequestData
{
    /**
     * The actual reference.
     */
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^[a-zA-Z0-9]{1,35}$/')]
    public string $reference;

    /**
     * Reference type.
     */
    #[Assert\Length(min: 1, max: 35)]
    public ?string $referenceType = null;

    /**
     * Identification of the issuer of the ReferenceType.
     */
    #[Assert\Length(min: 1, max: 35)]
    public ?string $referenceIssuer = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'Reference' => $this->reference,
            'ReferenceType' => $this->referenceType,
            'ReferenceIssuer' => $this->referenceIssuer,
        ], 'is_null');
    }
}
