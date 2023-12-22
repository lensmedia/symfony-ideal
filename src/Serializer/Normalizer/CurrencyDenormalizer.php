<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Serializer\Normalizer;

use Brick\Money\Currency;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class CurrencyDenormalizer implements DenormalizerInterface
{
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): Currency
    {
        return Currency::of($data);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return $type === Currency::class;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            Currency::class => true,
        ];
    }
}
