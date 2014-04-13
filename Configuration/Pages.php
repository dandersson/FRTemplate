<?php

namespace FRTemplate\Configuration;

/**
 * Return an array of the pages defined in the configuration.
 */
class Pages extends Base
{
    const CONFIG_SECTION = 'Pages';

    public function __construct()
    {
        parent::__construct();

        foreach ($this->ini[self::CONFIG_SECTION]['pages'] as $page) {
            foreach ($this->ini[self::CONFIG_SECTION][$page] as $language => $title) {
                $this->pages[$page][$language] = $title;
            }
        }

        unset($this->ini);
    }
}
