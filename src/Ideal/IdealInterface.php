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
    public const STATUS_COMPLETED = 'SettlementCompleted';
    public const STATUS_CANCELLED = 'Cancelled';
    public const STATUS_EXPIRED = 'Expired';
    public const STATUS_OPEN = 'Open';
    public const STATUS_ERROR = 'Error';

    public const CHECKOUT_PRICE_COMPLETED = 100;
    public const CHECKOUT_PRICE_CANCELLED = 200;
    public const CHECKOUT_PRICE_EXPIRED = 300;
    public const CHECKOUT_PRICE_OPEN = 400;
    public const CHECKOUT_PRICE_ERROR = 500;

    public function config(): Configuration;
}
