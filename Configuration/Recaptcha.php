<?php

namespace FRTemplate\Configuration;

/**
 * Present interface to reCaptcha related settings.
 */
class Recaptcha extends Base
{
    const CONFIG_SECTION = 'Recaptcha';

    public function __construct()
    {
        parent::__construct();

        $this->lib = $this->ini[self::CONFIG_SECTION]['lib'];
        $this->public_key = $this->ini[self::CONFIG_SECTION]['public_key'];
        $this->private_key = $this->ini[self::CONFIG_SECTION]['private_key'];
        $this->theme =
            array_key_exists('theme', $this->ini[self::CONFIG_SECTION]) ?
                $this->ini[self::CONFIG_SECTION]['theme'] :
                NULL;

        unset($this->ini);
    }
}
