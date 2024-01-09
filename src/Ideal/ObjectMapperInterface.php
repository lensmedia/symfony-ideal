<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

interface ObjectMapperInterface
{
    /**
     * Denormalizes data back into an object of the given class.
     *
     * @template T
     *
     * @param string|array $data Data to restore
     * @param class-string<T> $type The expected class to instantiate
     * @param array $context Options available to the denormalizer
     *
     * @return T
     */
    public function map(string|array $data, string $type, array $context = []): object;
}
