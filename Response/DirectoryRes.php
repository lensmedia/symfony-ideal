<?php

namespace Lens\Bundle\IdealBundle\Response;

final class DirectoryRes extends IdealResponse
{
    public function issuers(): array
    {
        $issuers = [];

        foreach ($this->content->Directory->children() as $item) {
            if ('Country' != $item->getName()) {
                continue;
            }

            foreach ($item->Issuer as $issuer) {
                $issuers[(string) $issuer->issuerID] = (string) $issuer->issuerName;
            }
        }

        return $issuers;
    }
}
