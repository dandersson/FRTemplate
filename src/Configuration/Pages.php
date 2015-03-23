<?php

namespace FRTemplate\Configuration;

/**
 * Return an array of the pages defined in the configuration.
 */
class Pages extends Base
{
    public function __construct()
    {
        parent::__construct();

        foreach ($this->ini['pages'] as $page) {
            foreach ($this->ini[$page] as $language => $title) {
                $this->pages[$page][$language] = $title;
            }
        }
    }
}
