<?php

namespace FRTemplate\Configuration;

/**
 * Present interface to email settings.
 */
class Email
{
    const CONFIG_SECTION = 'Email';

    public function __construct()
    {
        $ini = Base::getIni(self::CONFIG_SECTION);

        $this->destination = $ini['destination'];
    }
}
