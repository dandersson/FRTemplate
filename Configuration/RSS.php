<?php

namespace FRTemplate\Configuration;

/**
 * Present the RSS configuration of the site.
 */
class RSS extends Base
{
    const CONFIG_SECTION = 'RSS';

    public function __construct()
    {
        parent::__construct();

        $this->rss =
            array_key_exists(self::CONFIG_SECTION, $this->ini) ?
                $this->ini[self::CONFIG_SECTION] :
                NULL;

        unset($this->ini);
    }
}
