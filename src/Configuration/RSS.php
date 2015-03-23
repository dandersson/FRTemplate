<?php

namespace FRTemplate\Configuration;

/**
 * Present the RSS configuration of the site.
 */
class RSS extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->rss = $this->ini;
    }
}
