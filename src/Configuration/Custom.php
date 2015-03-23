<?php

namespace FRTemplate\Configuration;

/**
 * Retrieve and present custom variables.
 */
class Custom extends Base
{
    public function __construct($language='')
    {
        parent::__construct();

        $this->custom = [];
        if ($this->ini !== null) {
            foreach (array_keys($this->ini) as $key) {
                if (isset($this->ini[$key][$language])) {
                    $this->custom[$key] = $this->ini[$key][$language];
                }
            }
        }
    }
}
