<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

readonly final class Ideal implements IdealInterface
{
    public function __construct(
        private Configuration $configuration,
    ) {
    }
}
