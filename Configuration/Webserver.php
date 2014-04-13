<?php

namespace FRTemplate\Configuration;

/**
 * Present the relevant server configuration of the site.
 */
class Webserver extends Base
{
    const CONFIG_SECTION = 'Webserver';

    public function __construct()
    {
        parent::__construct();

        $this->mod_rewrite = (bool)$this->ini[self::CONFIG_SECTION]['mod_rewrite'];

        unset($this->ini);
    }
}
