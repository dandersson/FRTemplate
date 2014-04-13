<?php

namespace FRTemplate\Configuration;

/**
 * Retrieve and present the site configuration.
 */
class Site extends Base
{
    const CONFIG_SECTION = 'Site';

    public function __construct($language='')
    {
        parent::__construct();

        $this->siteTitle = $this->ini[self::CONFIG_SECTION]['title'];

        $this->startPage = $this->ini[self::CONFIG_SECTION]['start_page'];
        $this->defaultLanguage = $this->ini[self::CONFIG_SECTION]['languages'][0];

        $this->validLanguage =
            in_array($language, $this->ini[self::CONFIG_SECTION]['languages']) ?
                $language :
                $this->defaultLanguage;

        $this->languageLinkAlt = $this->ini[self::CONFIG_SECTION]['language_link_alt'];
        $this->languageLinkText = $this->ini[self::CONFIG_SECTION]['language_link_text'];

        $this->contactWebmaster = $this->ini[self::CONFIG_SECTION]['contact_webmaster'][$language];
        $this->metaDescription = $this->ini[self::CONFIG_SECTION]['meta_description'][$language];
        $this->metaKeywords = $this->ini[self::CONFIG_SECTION]['meta_keywords'][$language];

        unset($this->ini);
    }
}
