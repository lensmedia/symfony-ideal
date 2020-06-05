<?php

namespace Lens\Bundle\IdealBundle;

use Lens\Bundle\IdealBundle\Exception\IdealException;
use Lens\Bundle\IdealBundle\Exception\IdealTransactionException;
use Lens\Bundle\IdealBundle\Request\AcquirerStatusReq;
use Lens\Bundle\IdealBundle\Request\DirectoryReq;
use Lens\Bundle\IdealBundle\Request\IdealRequestOptions;
use Lens\Bundle\IdealBundle\Response\AcquirerStatusRes;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final class Ideal
{
    private $cache;
    private $directoryReq;
    private $acquirerStatusRequest;

    const STATUS_CACHE_INDEX = 'lens_ideal_bundle.status';
    const STATUS_CACHE_TTL = 60 * 5; // 5 minutes (for new and open) as restricted by ideal.

    const ISSUER_CACHE_INDEX = 'lens_ideal_bundle.issuer';
    const ISSUER_CACHE_TTL = 86400; // 60 * 60 * 24.

    public function __construct(
        CacheInterface $cache,
        AcquirerStatusReq $acquirerStatusRequest,
        DirectoryReq $directoryReq
    ) {
        $this->cache = $cache;
        $this->directoryReq = $directoryReq;
        $this->acquirerStatusRequest = $acquirerStatusRequest;
    }

    /**
     * @return array Associative array with BIC (key) and brand name (value)
     */
    public function issuers()
    {
        return $this->cache->get(self::ISSUER_CACHE_INDEX, function (ItemInterface $item) {
            $item->expiresAfter(self::ISSUER_CACHE_TTL);

            $response = $this->directoryReq->execute();

            return $response->issuers();
        });
    }

    /**
     * Check the status for a transaction. Note that as per ideal documented that an order
     * not new or of a status other than open is immutable, and status checks should not be done.
     *
     * @param IdealRequestOptions $options instance of options (requires filled index transaction)
     *
     * @throws IdealException when transaction id is missing
     *
     * @return AcquirerStatusRes
     */
    public function status(IdealRequestOptions $options)
    {
        $transaction = $options->get('transaction');
        if (null === $transaction) {
            throw new IdealException('Missing transaction from options required for status check.');
        }

        // transactionID format: PN..16
        if (!preg_match('/^\d{16}$/', $transaction)) {
            throw new IdealException('Invalid transaction in options required for status check.');
        }

        try {
            return $this->cache->get(static::STATUS_CACHE_INDEX.'.'.$transaction, function (ItemInterface $item) use ($options) {
                $item->expiresAfter(self::STATUS_CACHE_TTL);

                return $this->acquirerStatusRequest->execute($options);
            });
        } catch (IdealTransactionException $e) {
            return $e->getResponse();
        }
    }
}
