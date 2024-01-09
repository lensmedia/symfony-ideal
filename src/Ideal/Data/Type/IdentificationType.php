<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum IdentificationType: string
{
    case Iban = 'IBAN';
    case SortCodeAccountNumber = 'SortCodeAccountNumber';
}
