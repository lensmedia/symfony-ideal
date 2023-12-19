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
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface as SerializerExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

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
    public const CHECKOUT_PRICE_COMPLETED = 100;
    public const CHECKOUT_PRICE_CANCELLED = 200;
    public const CHECKOUT_PRICE_EXPIRED = 300;
    public const CHECKOUT_PRICE_OPEN = 400;
    public const CHECKOUT_PRICE_ERROR = 500;

    /**
     * Get the configuration.
     */
    public function config(): Configuration;

    /**
     * @template T
     *
     * @param array<string, mixed> $data
     * @param class-string<T> $class
     *
     * @return T
     *
     * @throws SerializerExceptionInterface
     */
    public function denormalize(array $data, string $class, array $context = []): object;

    public function get(string $url, array $options = []): array;
    public function post(string $url, array $options = []): array;
    public function put(string $url, array $options = []): array;
    public function delete(string $url, array $options = []): array;
}
