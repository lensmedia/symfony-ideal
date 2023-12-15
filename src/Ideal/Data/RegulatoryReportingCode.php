<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Information needed due to regulatory and statutory requirements. Economical codes to be used are provided by the
 * National Competent Authority
 */
class RegulatoryReportingCode implements SerializableRequestData
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 10)]
    public string $regulatoryReportingCode;

    public function jsonSerialize(): array
    {
        return [
            'RegulatoryReportingCode' => $this->regulatoryReportingCode,
        ];
    }
}
