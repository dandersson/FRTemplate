<?php

namespace FRTemplate\Configuration;

/**
 * Present interface to reCaptcha related settings.
 */
class Recaptcha extends Base
{
    public function __construct()
    {
        parent::__construct();

        $this->libdir = $this->ini['libdir'];
        $this->public_key = $this->ini['public_key'];
        $this->private_key = $this->ini['private_key'];
        $this->theme = array_key_exists('theme', $this->ini) ?
            $this->ini['theme'] :
            null;
    }
}
