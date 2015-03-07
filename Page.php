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
        // If we have a configuration entry e.g. index[sv-long], this can be
        // used as an alternate title to keep e.g. the navigation entry short,
        // but the site title long. if the `*-long` key is not present,
        // seamlessly present the default title as the `longTitle` attribute.
        $this->longTitle =
            array_key_exists(
                $this->language . FRCP::LONG_POSTFIX, $site->pages[$this->page]
            ) ?
            $site->pages[$this->page][$this->language . FRCP::LONG_POSTFIX] :
            $this->title;

        $this->preprocess = FRCP::PREPROCESS_INC . "$this->page.php";
        if (!file_exists($this->preprocess)) {
            $this->preprocess = NULL;
        }

        $this->postprocess = FRCP::POSTPROCESS_INC . "$this->page.php";
        if (!file_exists($this->postprocess)) {
            $this->postprocess = NULL;
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
        $this->postprocess === NULL or require($this->postprocess);
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
