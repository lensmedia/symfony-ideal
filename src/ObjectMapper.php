<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle;

use Lens\Bundle\IdealBundle\Ideal\ObjectMapperInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * The object mapper is used to map arrays of data to our ideal response data objects.
 *
 * Simple service to alias symfony's serializer denormalizer to the ideal object mapper interface. So we can easily
 * extract the iDEAL specific logic (Lens\Bundle\IdealBundle\Ideal\) from the bundle if we ever want to.
 */
readonly class ObjectMapper implements ObjectMapperInterface
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function map(string|array $data, string $type, array $context = []): object
    {
        if (is_string($data)) {
            return $this->serializer->deserialize($data, $type, 'json', $context);
        }

        return $this->serializer->denormalize($data, $type, 'json', $context);
    }
}
