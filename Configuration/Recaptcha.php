<?php

namespace FRTemplate\Configuration;

/**
 * Present interface to reCaptcha related settings.
 */
class Recaptcha
{
    const CONFIG_SECTION = 'Recaptcha';

    public function __construct()
    {
        $ini = Base::getIni(self::CONFIG_SECTION);

        $this->lib = $ini['lib'];
        $this->public_key = $ini['public_key'];
        $this->private_key = $ini['private_key'];
        $this->theme = array_key_exists('theme', $ini) ? $ini['theme'] : '';
    }
}
