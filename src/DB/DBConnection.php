<?php

namespace FRTemplate\DB;

/**
 * Creates MySQL connection via the `mysqli` interface with correct character
 * encoding set. Returns `mysqli` handle via `$this->mysqli`.
 *
 * Can be used to add error handling capabilities in the future; preferably
 * with verbosity dependent on a debug parameter in the site configuration.
 */
class DBConnection
{
    protected $mysqli;

    public function __construct()
    {
        $cdb = new \FRTemplate\Configuration\DB();
        $this->mysqli = new \mysqli($cdb->host, $cdb->username, $cdb->password,
            $cdb->database);
        $this->mysqli->set_charset($cdb->charset);
    }
}
