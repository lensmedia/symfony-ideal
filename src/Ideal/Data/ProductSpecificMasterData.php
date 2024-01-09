<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Symfony\Component\Validator\Constraints as Assert;

class ProductSpecificMasterData implements SerializableRequestData
{
    /**
     * Name of the parameter exactly as required by the payment method.
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 250)]
    public string $paramName;

    /**
     * Actual value of the parameter.
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 1, max: 2048)]
    public string $paramValue;

    public function jsonSerialize(): array
    {
        return [
            'ParamName' => $this->paramName,
            'ParamValue' => $this->paramValue,
        ];
    }
}
