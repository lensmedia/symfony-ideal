<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum TransactionType: string
{
    case Online = 'Online';
    case Qr = 'QR';
    case Instore = 'Instore';
    case P2p = 'P2P';
}
