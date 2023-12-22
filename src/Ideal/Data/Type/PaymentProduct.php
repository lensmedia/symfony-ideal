<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum PaymentProduct: string
{
    case Psd2Sct = 'PSD2-SCT';
    case Psd2SctInst = 'PSD2-SCT-Inst';
    case Psd2Target2 = 'PSD2-Target2';
    case Psd2Domestic = 'PSD2-Domestic';

    case Ideal = 'IDEAL';
}
