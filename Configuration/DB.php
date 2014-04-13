<?php

namespace FRTemplate\Configuration;

/**
 * Present the database configuration of the site.
 */
class DB
{
    const CONFIG_SECTION = 'DB';

    public function __construct()
    {
        $ini = Base::getIni(self::CONFIG_SECTION);

        $this->host = $ini['host'];
        $this->username = $ini['username'];
        $this->password = $ini['password'];
        $this->database = $ini['database'];
        $this->charset = $ini['charset'];
    }
}
