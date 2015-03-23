<?php

namespace FRTemplate\Configuration;

/**
 * Read INI-style configuration files.
 */
abstract class Base
{
    /**
     * Present wanted configuration from corresponding file.
     */
    public function __construct($parse_sections = false)
    {
        // Return the class name without the namespace qualifier.
        $class_name = substr(static::class, strrpos(static::class, '\\') + 1);
        $config_file = 'config/' . mb_strtolower($class_name) . '.ini.php';
        $this->ini = file_exists($config_file) ?
            parse_ini_file($config_file, $parse_sections) :
            null;
    }
}
