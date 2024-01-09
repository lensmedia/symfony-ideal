<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use Lens\Bundle\IdealBundle\Ideal\Data\Link;
use Lens\Bundle\IdealBundle\Ideal\Exception\ErrorResponse;
use Lens\Bundle\IdealBundle\Ideal\Exception\InvalidArgument;
use Lens\Bundle\IdealBundle\Ideal\Resource\Authorize;
use Lens\Bundle\IdealBundle\Ideal\Resource\BulkPayments;
use Lens\Bundle\IdealBundle\Ideal\Resource\Payments;
use Lens\Bundle\IdealBundle\Ideal\Resource\PeriodicPayments;
use Lens\Bundle\IdealBundle\Ideal\Resource\Preferences;
use Lens\Bundle\IdealBundle\Ideal\Resource\Refunds;
use Lens\Bundle\IdealBundle\Ideal\Resource\ScheduledPayments;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

readonly final class Ideal implements IdealInterface
{
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
        private ?ObjectMapperInterface $objectMapper = null,
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

    public function isNotificationTokenValid(string $token): bool
    {
        return $this->config()->notificationToken === $token;
    }

    public function map(string|array $data, string $type, array $context = []): object
    {
        return $this->objectMapper->map($data, $type, $context);
    }

    public function get(string $url, array $options = [], ?string $type = null): array|object
    {
        return $this->request(Request::METHOD_GET, $url, $options, $type);
    }

    public function post(string $url, array $options = [], ?string $type = null): array|object
    {
        return $this->request(Request::METHOD_POST, $url, $options, $type);
    }

    public function put(string $url, array $options = [], ?string $type = null): array|object
    {
        return $this->request(Request::METHOD_PUT, $url, $options, $type);
    }

    public function delete(string $url, array $options = [], ?string $type = null): array|object
    {
        return $this->request(Request::METHOD_DELETE, $url, $options, $type);
    }

    private function request(string $method, string $url, array $options = [], ?string $type = null): array|object
    {
        $headers = &$options['headers'];
        if (isset($headers['InitiatingPartyNotificationUrl']) && !isset($headers['NotificationVersion'])) {
            if (!preg_match('~^https?://~', $headers['InitiatingPartyNotificationUrl'])) {
                throw new InvalidArgument(sprintf(
                    'The "InitiatingPartyNotificationUrl" header must be a full URL, "%s" given.',
                    $headers['InitiatingPartyNotificationUrl'],
                ));
            }

            $headers['NotificationVersion'] = IdealInterface::VERSION;
        }

        $response = $this->httpClient->request($method, $url, $options);
        if ($type && $this->objectMapper instanceof ObjectMapperInterface) {
            return $this->requestWithType($response, $type);
        }

        try {
            $data = $response->toArray();
            $data['response'] = $response;

            return $data;
        } catch (HttpExceptionInterface $exception) {
            $this->throwErrorResponseException($exception);
        }
    }

    /**
     * @throws TransportExceptionInterface
     */
    private function requestWithType(ResponseInterface $response, string $type): object
    {
        if (!class_exists($type)) {
            throw new InvalidArgument(sprintf(
                'Class "%s" does not exist.',
                $type,
            ));
        }

        try {
            $data = $this->map($response->getContent(), $type);
            if (is_a($data, IdealResponseInterface::class, true)) {
                $data->setResponse($response);
            }

            return $data;
        } catch (HttpExceptionInterface $exception) {
            $this->throwErrorResponseException($exception);
        }
    }

    private function throwErrorResponseException(HttpExceptionInterface $exception): never
    {
        $response = $exception->getResponse();

        $data = $response->toArray(false);
        if (empty($data)) {
            $message = trim($response->getContent(false));
            if (empty($message)) {
                $message = $exception->getMessage();
            }

            throw new ErrorResponse(
                code: 0,
                statusCode: $response->getStatusCode(),
                message: $message,
                headers: $response->getHeaders(false),
                previous: $exception,
            );
        }

        $link = null;
        if (isset($data['link'])) {
            $link = $this->map($data['link'], Link::class);
        }

        throw new ErrorResponse(
            code: (int)$data['code'],
            statusCode: $response->getStatusCode(),
            message: $data['message'] ?? 'Unknown error.',
            details: $data['details'] ?? null,
            link: $link,
            headers: $response->getHeaders(false),
            previous: $exception,
        );
    }
}
