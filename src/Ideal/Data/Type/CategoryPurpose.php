<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

/**
 * Specifies the high level purpose of the instruction based on a set of pre-defined categories. This is used by the
 * initiating party to provide information concerning the processing of the payment. It is likely to trigger special
 * processing by any of the agents involved in the payment chain. Not all the given codes might be accepted by all
 * banks. The standard for STET for example is limited to CASH, CORT, DVPM, INTC and TREA.
 */
enum CategoryPurpose: string
{
    case Cash = 'CASH';
    case Cort = 'CORT';
    case Divi = 'DIVI';
    case Dvpm = 'DVPM';
    case Intc = 'INTC';
    case Inte = 'INTE';
    case Pens = 'PENS';
    case Sala = 'SALA';
    case Ssbe = 'SSBE';
    case Supp = 'SUPP';
    case Taxs = 'TAXS';
    case Trea = 'TREA';
}
