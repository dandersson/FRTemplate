<?php

namespace FRTemplate\Configuration;

/**
 * Present the relevant server configuration of the site.
 */
class Webserver extends Base
{
    public function __construct()
    {
        parent::__construct();

        // See `FRTemplate/Site.php:link()` for `mod_rewrite` definition.
        $this->mod_rewrite = (bool)$this->ini['mod_rewrite'];
    }
}
