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
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly final class Ideal implements IdealInterface
{
    public const APP = 'IDEAL';

    public Authorize $authorize;
    public Payments $payments;
    public ScheduledPayments $scheduledPayments;
    public PeriodicPayments $periodicPayments;
    public BulkPayments $bulkPayments;
    public Refunds $refunds;
    public Preferences $preferences;

    private HttpClientInterface $httpClient;

    public function __construct(
        private Configuration $config,
        private DenormalizerInterface $denormalizer,
    ) {
        $this->httpClient = HttpClient::createForBaseUri($this->config->baseUrl);

        // Initiate resource repositories.
        $this->authorize = new Authorize($this);
        $this->payments = new Payments($this);
        $this->scheduledPayments = new ScheduledPayments($this);
        $this->periodicPayments = new PeriodicPayments($this);
        $this->bulkPayments = new BulkPayments($this);
        $this->refunds = new Refunds($this);
        $this->preferences = new Preferences($this);
    }

    public function config(): Configuration
    {
        return $this->config;
    }

    public function denormalize(array $data, string $class, array $context = []): object
    {
        return $this->denormalizer->denormalize($data, $class, null, $context);
    }

    public function get(string $url, array $options = []): array
    {
        return $this->request(Request::METHOD_GET, $url, $options);
    }

    public function post(string $url, array $options = []): array
    {
        return $this->request(Request::METHOD_POST, $url, $options);
    }

    public function put(string $url, array $options = []): array
    {
        return $this->request(Request::METHOD_PUT, $url, $options);
    }

    public function delete(string $url, array $options = []): array
    {
        return $this->request(Request::METHOD_DELETE, $url, $options);
    }

    private function request(string $method, string $url, array $options = []): array
    {
        return $this->httpClient->request($method, $url, $options)->toArray();
    }
}
