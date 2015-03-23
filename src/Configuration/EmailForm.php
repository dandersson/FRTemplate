<?php

namespace FRTemplate\Configuration;

/**
 * Present interface to e-mail form settings.
 */
class EmailForm extends Base
{
    public function __construct($language)
    {
        parent::__construct(true);

        $this->label = $this->ini[$language]['label'];
        $this->status = $this->ini[$language]['status'];
    }
}
