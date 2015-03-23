<?php

namespace FRTemplate\Configuration;

/**
 * Present interface to email settings.
 */
class Email extends Base
{
    public function __construct()
    {
        parent::__construct();

        $this->destination = $this->ini['destination'];
    }
}
