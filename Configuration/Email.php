<?php

namespace FRTemplate\Configuration;

/**
 * Present interface to email settings.
 */
class Email extends Base
{
    const CONFIG_SECTION = 'Email';

    public function __construct()
    {
        parent::__construct();

        $this->destination = $this->ini[self::CONFIG_SECTION]['destination'];

        unset($this->ini);
    }
}
