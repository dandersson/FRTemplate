<?php

namespace FRTemplate\Configuration;

/**
 * Present the database configuration of the site.
 */
class DB extends Base
{
    public function __construct()
    {
        parent::__construct();

        $this->host = $this->ini['host'];
        $this->username = $this->ini['username'];
        $this->password = $this->ini['password'];
        $this->database = $this->ini['database'];
        $this->charset = $this->ini['charset'];
    }
}
