<?php

namespace FRTemplate\Configuration;

/**
 * Retrieve and present custom variables.
 */
class Custom
{
    const CONFIG_SECTION = 'Custom';

    public function __construct($language='')
    {
        $ini = Base::getIni(self::CONFIG_SECTION);

        $this->custom = [];
        foreach (array_keys($ini) as $custom_entry) {
            if (isset($ini[$custom_entry][$language])) {
                $this->custom[$custom_entry] = $ini[$custom_entry][$language];
            }
        }
    }
}
