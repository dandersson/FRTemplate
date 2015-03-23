<?php

namespace FRTemplate\Configuration;

/**
 * Retrieve and present the site configuration.
 */
class Site extends Base
{
    public function __construct($language='')
    {
        parent::__construct();

        $this->siteTitle = $this->ini['title'];

        $this->startPage = $this->ini['start_page'];
        $this->defaultLanguage = $this->ini['languages'][0];

        $this->validLanguage =
            in_array($language, $this->ini['languages']) ?
                $language :
                $this->defaultLanguage;

        $this->languageLinkAlt = $this->ini['language_link_alt'];
        $this->languageLinkText = $this->ini['language_link_text'];

        $this->contactWebmaster = $this->ini['contact_webmaster'][$this->validLanguage];
        $this->metaDescription = $this->ini['meta_description'][$this->validLanguage];
        $this->metaKeywords = $this->ini['meta_keywords'][$this->validLanguage];
    }
}
