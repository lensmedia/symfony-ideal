<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Serializer\Normalizer;

use Brick\Math\BigDecimal;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class BigDecimalDenormalizer implements DenormalizerInterface
{
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): BigDecimal
    {
        return is_float($data)
            ? BigDecimal::fromFloatShortest($data)
            : BigDecimal::of($data);
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === BigDecimal::class;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            BigDecimal::class => true,
        ];
    }
}
