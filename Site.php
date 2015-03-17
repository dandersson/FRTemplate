<?php

namespace FRTemplate;

use FRTemplate\Constants\Pages as FRCP;

 /**
  * General site methods and structures.
  */
class Site
{
    /**
     * Create language dependent site interface.
     */
    public function __construct()
    {
        $language = isset($_GET[FRCP::LANGUAGE]) ? $_GET[FRCP::LANGUAGE] : '';
        $this->config = new Configuration\Site($language);
        $this->language = $this->config->validLanguage;

        $page_config = new Configuration\Pages();
        $this->pages = $page_config->pages;

        $rss = new Configuration\RSS();
        if ($rss->rss !== NULL) {$this->rss = $rss->rss;}

        $this->webserver = new Configuration\Webserver();

        $custom = new Configuration\Custom($this->language);
        $this->custom = $custom->custom;
    }

    /**
     * Return correctly formatted intralink.
     */
    public function link($page, $language='')
    {
        if ($language === '') {$language = $this->language;}
        if ($this->webserver->mod_rewrite) {
            // Sample `mod_rewrite` rules for the current configuration:
            //
            //     RewriteEngine on
            //     RewriteRule ^([a-z]{2})-([a-z]+)/?$ index.php?page=$2&language=$1 [L,QSA]
            return "$language-$page";
        } else {
            return '?' . http_build_query([
                FRCP::PAGE => $page,
                FRCP::LANGUAGE => $language
            ]);
        }
    }

    /**
     * Handle requested pages not defined in the configuration.
     */
    public function pageDoesNotExist()
    {
        // Non-existent pages should return 404 and not blindly be redirected
        // to the start page.
        http_response_code(404);
        $custom_404 = FRCP::TEMPLATE_INC . '404.php';
        if (file_exists($custom_404)) {
            include $custom_404;
        } else {
            die("<!DOCTYPE html>
            <meta charset=\"utf-8\">
            <title>Not Found</title>
            <h1>Not Found</h1>
            <p>The requested URL was not found on this server.
            <hr>
            <address>{$this->config->siteTitle}</address>
            ");
        }
        exit;
    }

    /**
     * Handle pages that are existent in the configuration, but where the
     * internal page resource is non-existent.
     */
    public function fileDoesNotExist()
    {
        // A non-existent file means that the configuration or internal
        // directory structure is malformed. That is an internal server error,
        // in my view.
        http_response_code(500);
        $custom_500 = FRCP::TEMPLATE_INC . '500.php';
        if (file_exists($custom_500)) {
            include $custom_500;
        } else {
            die("<!DOCTYPE html>
            <meta charset=\"utf-8\">
            <title>500 Internal Server Error</title>
            <h1>Internal Server Error</h1>
            <p>The web site encountered an internal misconfiguration and was 
            unable to complete your request. Sorry!
            <hr>
            <address>{$this->config->siteTitle}</address>
            ");
        }
        exit;
    }
}
