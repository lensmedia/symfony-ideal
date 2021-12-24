<?php

namespace Lens\Bundle\IdealBundle\Request;

use Symfony\Component\HttpFoundation\ParameterBag;

class IdealRequestOptions extends ParameterBag
{
    public function default(string $index, $value): void
    {
        if ($this->has($index)) {
            return;
        }

        $this->set($index, $value);
    }
}
