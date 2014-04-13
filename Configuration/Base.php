<?php

namespace FRTemplate\Configuration;

/**
 * Read configuration INI file and expose contents to inheriting classes.
 */
class Base
{
    protected $ini;

    public function __construct($config_file=NULL)
    {
        $config_file = $config_file ?: \FRTemplate\Constants\ConfigFiles::SITE;
        $this->ini = parse_ini_file($config_file, true);
    }
}
