<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

class CredentialLabel
{
    /**
     * The label associated to the credentials to show to the PSU.
     */
    public string $label;

    /**
     * Label internationalization. It specifies the language of the label. The default value is EN.
     */
    public string $language;
}
