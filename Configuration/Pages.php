<?php

namespace FRTemplate\Configuration;

/**
 * Return an array of the pages defined in the configuration.
 */
class Pages
{
    const CONFIG_SECTION = 'Pages';

    public function __construct()
    {
        $ini = Base::getIni(self::CONFIG_SECTION);

        foreach ($ini['pages'] as $page) {
            foreach ($ini[$page] as $language => $title) {
                $this->pages[$page][$language] = $title;
            }
        }
    }
}
