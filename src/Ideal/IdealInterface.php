<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use Lens\Bundle\IdealBundle\Ideal\Exception\ErrorResponse;
use Lens\Bundle\IdealBundle\Ideal\Resource\Authorize;
use Lens\Bundle\IdealBundle\Ideal\Resource\BulkPayments;
use Lens\Bundle\IdealBundle\Ideal\Resource\Payments;
use Lens\Bundle\IdealBundle\Ideal\Resource\PeriodicPayments;
use Lens\Bundle\IdealBundle\Ideal\Resource\Preferences;
use Lens\Bundle\IdealBundle\Ideal\Resource\Refunds;
use Lens\Bundle\IdealBundle\Ideal\Resource\ScheduledPayments;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * @property-read Authorize $authorize
 * @property-read Payments $payments
 * @property-read ScheduledPayments $scheduledPayments
 * @property-read PeriodicPayments $periodicPayments
 * @property-read BulkPayments $bulkPayments
 * @property-read Refunds $refunds
 * @property-read Preferences $preferences
 */
interface IdealInterface extends ObjectMapperInterface
{
    public const APP = 'IDEAL';
    public const VERSION = 'v3';

    public const DEBUG_PRICE_COMPLETED = '1.00';
    public const DEBUG_PRICE_CANCELLED = '2.00';
    public const DEBUG_PRICE_EXPIRED = '3.00';
    public const DEBUG_PRICE_OPEN = '4.00';
    public const DEBUG_PRICE_ERROR = '5.00';

    /**
     * Get the configuration.
     */
    public function config(): Configuration;

    /**
     * Returns true if the provided notification token is the same as configured. The notification token
     * is set in the Rabobank dashboard.
     */
    public function isNotificationTokenValid(string $token): bool;

    /**
     * @template T
     *
     * @param class-string<T> $type
     *
     * @return T|array
     *
     * @throws TransportExceptionInterface if the request failed
     * @throws ErrorResponse if the response is an error response
     */
    public function get(string $url, array $options = [], ?string $type = null): array|object;

    /**
     * @template T
     *
     * @param class-string<T> $type
     *
     * @return T|array
     *
     * @throws TransportExceptionInterface if the request failed
     * @throws ErrorResponse if the response is an error response
     */
    public function post(string $url, array $options = [], ?string $type = null): array|object;

    /**
     *
     * @template T
     *
     * @param class-string<T> $type
     *
     * @return T|array
     *
     * @throws TransportExceptionInterface if the request failed
     * @throws ErrorResponse if the response is an error response
     */
    public function put(string $url, array $options = [], ?string $type = null): array|object;

    /**
     *
     * @template T
     *
     * @param class-string<T> $type
     *
     * @return T|array
     *
     * @throws TransportExceptionInterface if the request failed
     * @throws ErrorResponse if the response is an error response
     */
    public function delete(string $url, array $options = [], ?string $type = null): array|object;
}
