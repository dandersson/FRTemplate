<?php

namespace FRTemplate\Configuration;

/**
 * Present the relevant server configuration of the site.
 */
class Webserver
{
    const CONFIG_SECTION = 'Webserver';

    public function __construct()
    {
        $ini = Base::getIni(self::CONFIG_SECTION);

        $this->mod_rewrite = (bool)$ini['mod_rewrite'];
    }
}
