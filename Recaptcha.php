<?php

namespace FRTemplate;

use Constants\Recaptcha as CSR;

/**
 * Initiate reCaptcha interface.
 */
class Recaptcha
{
    public function __construct()
    {
        $config = new Configuration\Recaptcha();
        $this->lib = $config->lib;
        $this->public_key = $config->public_key;
        $this->private_key = $config->private_key;
        $this->theme = $config->theme;

        require $this->lib;
    }
}
