<?php

namespace FRTemplate;

use FRTemplate\Constants\Pages as FRCP;

/**
 * Interfaces for a page object.
 */
class Page
{
    /**
     * Construct a page component of the given Site object.
     */
    public function __construct($site)
    {
        $this->site = $site;
        $this->language = $site->language;

        // If no URL component is given, return start page. This could also
        // have been implemented within Apache and mod_rewrite.
        $this->page = isset($_GET['page']) ?
            $_GET['page'] :
            $site->config->startPage;

        if (!array_key_exists($this->page, $site->pages)) {
            $site->pageDoesNotExist();
            exit;
        }

        $this->file = FRCP::PAGE_INC . "{$this->page}-{$this->language}.php";

        if (!file_exists($this->file)) {
            $site->fileDoesNotExist();
        }

        $this->title = $site->pages[$this->page][$this->language];

        $this->preprocess = FRCP::PREPROCESS_INC . "$this->page.php";
        if (!file_exists($this->preprocess)) {
            $this->preprocess = NULL;
        }
    }

    /**
     * Print page contents to user, including general templates.
     */
    public function printPage()
    {
        $site = new Site($this->language);
        $this->preprocess === NULL or require($this->preprocess);
        require FRCP::TEMPLATE_INC . 'header.php';
        require $this->file;
        require FRCP::TEMPLATE_INC . 'footer.php';
    }

    /**
     * Create compund title of site and individual page name.
     */
    public function printTitle()
    {
        return $this->site->config->siteTitle .
            ($this->title !== '' ? " — $this->title" : '');
    }

    /**
     * Utility function for crosslinks between Swedish/English site versions.
     */
    public function alternateLanguageSvEn()
    {
        return $this->language === 'sv' ? 'en' : 'sv';
    }
}
