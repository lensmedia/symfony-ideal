<?php

namespace Lens\Bundle\IdealBundle\Request;

use DOMDocument;
use Exception;
use Lens\Bundle\IdealBundle\Response\IdealResponse;
use Lens\Bundle\IdealBundle\Response\Response;
use RobRichards\XMLSecLibs\XMLSecEnc;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use Symfony\Component\HttpFoundation\File\File;

abstract class IdealRequest implements IdealRequestInterface
{
    const STATE_STATUS = 0;
    const STATE_HEADERS = 1;
    const STATE_CONTENT = 2;

    const CRLF = "\r\n";

    protected $options;
    private $document;

    public function __construct(array $options)
    {
        $this->options = $options;
    }

    abstract public function message(IdealRequestOptions $options): DOMDocument;

    public function execute(IdealRequestOptions $options = null): IdealResponse
    {
        $url = $this->acquirerUrl();

        $target = [];
        if (!preg_match('~^(?P<protocol>[a-z]+://)(?P<host>[^:]+):(?P<port>\d+)(?P<path>.*)$~mi', $url, $target)) {
            throw new Exception(sprintf(
                "Unable to parse acquirer URL '%s' for request.",
                $url
            ));
        }

        if (!$options) {
            $options = new IdealRequestOptions();
        }

        $options->set('merchant_id', $this->options['merchant_id']);
        $options->set('sub_id', $this->options['sub_id']);

        $request = $this->message($options);
        $request = $this->sign($request)->saveXML();

        $socket = fsockopen($target['protocol'].$target['host'], $target['port'], $errno, $errstr, @$this->options['timeout'] || 30);
        if (!$socket) {
            throw new Exception(sprintf(
                "Unable to connect to URL '%s': [%d] %s.",
                $url,
                $errno,
                $errstr
            ));
        }

        $headers = [
            'POST '.$target['path'].' HTTP/1.0',
            'Host: '.$target['host'],
            'Content-Type: text/xml',
            'Content-Length: '.strlen($request),
        ];

        fputs(
            $socket,
            implode(self::CRLF, $headers).self::CRLF.self::CRLF.$request
        );

        $state = self::STATE_STATUS;
        $status = '';
        $headers = [];
        $content = '';
        while (!feof($socket)) {
            $segment = @fgets($socket);

            if (self::STATE_STATUS == $state) {
                if (!preg_match('~[a-z]+/[\d\.]+\s(?P<status>\d+)\s~i', $segment, $out)) {
                    throw new Exception('Response is empty or invalid');
                }

                $status = (int) $out['status'];

                $state = self::STATE_HEADERS;
            } elseif (self::STATE_HEADERS == $state) {
                if (preg_match('~^[\r\n]+$~', $segment)) {
                    $state = self::STATE_CONTENT;
                } else {
                    list($header, $value) = explode(':', $segment, 2);
                    $headers[$header] = trim($value);
                }
            } else {
                $content .= $segment;
            }
        }

        fclose($socket);

        if (!$this->verify(DOMDocument::loadXML($content))) {
            throw new Exception('Response validation failed');
        }

        return IdealResponse::create($status, $headers, $content);
    }

    protected function timestamp(): string
    {
        return gmdate('Y-m-d\TH:i:s.000\Z');
    }

    private function privateKeyPassword(): ?string
    {
        return $this->options['private_key_pass'];
    }

    private function privateKeyFile(): File
    {
        return new File($this->options['certificate_path'].$this->options['private_key_file']);
    }

    private function privateCertificateFile(): File
    {
        return new File($this->options['certificate_path'].$this->options['private_certificate_file']);
    }

    private function publicCertificateFile(): File
    {
        $path = $this->options['certificate_path'];
        if (null !== $this->options['public_certificate_file']) {
            return new File($path.$this->options['public_certificate_file']);
        }

        $acquirer = $this->options['acquirer'];

        $publicCertificateFiles = [
            'abn' => 'abnamro.cer',
            'deu' => 'deutschebank.cer',
            'fries' => 'frieslandbank.cer',
            'ing' => 'ingbank.cer',
            'rabo' => 'rabobank.cer',
            'sim' => 'simulator.cer',
        ];

        foreach ($publicCertificateFiles as $acquirerPart => $certificate) {
            if (false === stripos($acquirer, $acquirerPart)) {
                continue;
            }

            return new File($path.$certificate);
        }

        throw new Exception('Unknown acquirer configured.');
    }

    private function acquirerUrl(): string
    {
        $acquirer = $this->options['acquirer'];
        $test = $this->options['test'];

        $acquirer = strtolower($acquirer);

        $acquirerUrls = [
            'abn' => 'ssl://abnamro'.($test ? '-test' : '').'.ideal-payment.de:443/ideal/iDEALv3',
            'deu' => 'ssl://ideal'.($test ? 'test' : '').'.db.com:443/ideal/iDEALv3',
            'fries' => 'ssl://'.($test ? 'test' : '').'idealkassa.frieslandbank.nl:443/ideal/iDEALv3',
            'ing' => 'ssl://ideal'.($test ? 'test' : '').'.secure-ing.com:443/ideal/iDEALv3',
            'rabo' => 'ssl://ideal'.($test ? 'test' : '').'.rabobank.nl:443/ideal/iDEALv3',
            'sim' => 'ssl://www.ideal-simulator.nl:443/professional-v3/',
        ];

        foreach ($acquirerUrls as $acquirerPart => $url) {
            if (false === stripos($acquirer, $acquirerPart)) {
                continue;
            }

            return $url;
        }

        throw new Exception('Unknown acquirer configured.');
    }

    private function sign(DOMDocument $document): DOMDocument
    {
        $signature = new XMLSecurityDSig();
        $signature->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $signature->addReference(
            $document,
            XMLSecurityDSig::SHA256,
            ['http://www.w3.org/2000/09/xmldsig#enveloped-signature'],
            ['force_uri' => true]
        );

        $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, ['type' => 'private']);
        $key->passphrase = $this->privateKeyPassword();
        $key->loadKey($this->privateKeyFile(), true);

        $keyName = $this->getCertificateFingerprint($this->privateCertificateFile());
        $this->appendKeyNameToKeyInfo($signature, $keyName);

        $signature->sign($key);
        $signature->appendSignature($document->documentElement);

        return $document;
    }

    private function verify(DOMDocument $document): bool
    {
        $ds = new XMLSecurityDSig();
        $signature = $ds->locateSignature($document);
        if (!$signature) {
            return false;
        }

        $ds->canonicalizeSignedInfo();
        $ds->idKeys = ['ID'];
        if (!$ds->validateReference()) {
            return false;
        }

        $key = $ds->locateKey();
        if (!$key) {
            return false;
        }

        $keyInfo = XMLSecEnc::staticLocateKeyInfo($key, $ds);
        $key->loadKey('file://'.$this->publicCertificateFile(), false, true);

        return $ds->verify($key);
    }

    private function appendKeyNameToKeyInfo(XMLSecurityDSig $signature, string $name): XMLSecurityDSig
    {
        if (empty($name)) {
            return $signature;
        }

        $child = $signature->createNewSignNode('KeyName', $name);
        $signature->appendToKeyInfo($child);

        return $signature;
    }

    private function getCertificateFingerprint(File $path): string
    {
        return openssl_x509_fingerprint('file://'.(string) $path, 'sha1');
    }
}
