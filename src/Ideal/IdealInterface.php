<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use Lens\Bundle\IdealBundle\Ideal\Resource\Authorize;
use Lens\Bundle\IdealBundle\Ideal\Resource\BulkPayments;
use Lens\Bundle\IdealBundle\Ideal\Resource\Payments;
use Lens\Bundle\IdealBundle\Ideal\Resource\PeriodicPayments;
use Lens\Bundle\IdealBundle\Ideal\Resource\Preferences;
use Lens\Bundle\IdealBundle\Ideal\Resource\Refunds;
use Lens\Bundle\IdealBundle\Ideal\Resource\ScheduledPayments;

/**
 * @property-read Authorize $authorize
 * @property-read Payments $payments
 * @property-read ScheduledPayments $scheduledPayments
 * @property-read PeriodicPayments $periodicPayments
 * @property-read BulkPayments $bulkPayments
 * @property-read Refunds $refunds
 * @property-read Preferences $preferences
 */
interface IdealInterface
{
    public function config(): Configuration;
}
