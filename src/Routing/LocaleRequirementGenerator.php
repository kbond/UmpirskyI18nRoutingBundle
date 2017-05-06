<?php

namespace Umpirsky\I18nRoutingBundle\Routing;

class LocaleRequirementGenerator
{
    private $locales;

    public function __construct(array $locales)
    {
        $this->locales = $locales;
    }

    public function generate(): string
    {
        return implode('|', $this->locales);
    }
}
