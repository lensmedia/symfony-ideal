<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Symfony\Component\Validator\Constraints as Assert;

class Link
{
    #[Assert\Length(min: 1, max: 1024)]
    public string $href;

    public function __toString(): string
    {
        return $this->href;
    }
}
