<?php

namespace FRTemplate\Configuration;

/**
 * Read configuration files.
 */
class Base
{
    /**
     * Present wanted configuration section from corresponding file.
     */
    public static function getIni($config_section)
    {
        $config_file = 'config/' . mb_strtolower($config_section) . '.ini.php';
        return file_exists($config_file) ? parse_ini_file($config_file) : NULL;
    }
}
