<?php

namespace FRTemplate\Configuration;

/**
 * Retrieve and present the site configuration.
 */
class Site
{
    const CONFIG_SECTION = 'Site';

    public function __construct($language='')
    {
        $ini = Base::getIni(self::CONFIG_SECTION);

        $this->siteTitle = $ini['title'];

        $this->startPage = $ini['start_page'];
        $this->defaultLanguage = $ini['languages'][0];

        $this->validLanguage =
            in_array($language, $ini['languages']) ?
                $language :
                $this->defaultLanguage;

        $this->languageLinkAlt = $ini['language_link_alt'];
        $this->languageLinkText = $ini['language_link_text'];

        $this->contactWebmaster = $ini['contact_webmaster'][$this->validLanguage];
        $this->metaDescription = $ini['meta_description'][$this->validLanguage];
        $this->metaKeywords = $ini['meta_keywords'][$this->validLanguage];
    }
}
