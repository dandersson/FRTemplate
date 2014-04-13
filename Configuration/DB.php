<?php

namespace FRTemplate\Configuration;

/**
 * Present the database configuration of the site.
 */
class DB extends Base
{
    const CONFIG_SECTION = 'Database';

    public function __construct()
    {
        parent::__construct(\FRTemplate\Constants\ConfigFiles::DB);

        $this->host = $this->ini[self::CONFIG_SECTION]['host'];
        $this->username = $this->ini[self::CONFIG_SECTION]['username'];
        $this->password = $this->ini[self::CONFIG_SECTION]['password'];
        $this->database = $this->ini[self::CONFIG_SECTION]['database'];
        $this->charset = $this->ini[self::CONFIG_SECTION]['charset'];

        unset($this->ini);
    }
}
