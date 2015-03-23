<?php

namespace FRTemplate;

/**
 * URL mangling utility functions.
 */
class URL
{
    /**
     * Return full URL to current host.
     */
    public static function fullHostURL()
    {
        switch ($_SERVER['SERVER_PORT']) {
            case 443:
                return "https://{$_SERVER['SERVER_NAME']}";
            case 80:
                return "http://{$_SERVER['SERVER_NAME']}";
            default:
                return "http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}";
        }
    }

    /**
     * Return full URL to the directory containing the current script.
     */
    public static function fullBaseURL()
    {
        // `strstr` has a third optional parameter to switch which part is
        // returned, but I want the _last_ occurence of `/`, not the first.
        // `strrchr` gets this, but has no such optional parameter, so I
        // emulate it with `substr`, and use `mb_substr` to not walk into
        // unicode traps.
        return self::fullHostURL() .
            mb_substr(
                $_SERVER['SCRIPT_NAME'],
                0,
                -mb_strlen(strrchr($_SERVER['SCRIPT_NAME'], '/'))
            );
    }

    /**
     * Robust query addition, even if a query (and anchor) is already present.
     */
    public static function addHttpQuery($url, $query)
    {
        $fragment = parse_url($url, PHP_URL_FRAGMENT);
        $separator = (parse_url($url, PHP_URL_QUERY) === NULL) ? '?' : '&';
        if ($fragment === NULL) {
            return $url . $separator . $query;
        } else {
            return strstr($url, '#', true) . $separator . $query . $fragment;
        }
    }
}
