<?php

namespace FRTemplate\Configuration;

/**
 * Present the RSS configuration of the site.
 */
class RSS
{
    const CONFIG_SECTION = 'RSS';

    public function __construct()
    {
        $this->rss = Base::getIni(self::CONFIG_SECTION);
    }
}
