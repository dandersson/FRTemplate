<?php

namespace FRTemplate;

use Constants\Recaptcha as CSR;

/**
 * Initiate reCaptcha interface.
 */
class Recaptcha
{
    public function __construct($language='en')
    {
        $config = new Configuration\Recaptcha();

        $this->public_key = $config->public_key;
        $this->private_key = $config->private_key;

        // Natively supported languages from
        // <https://developers.google.com/recaptcha/docs/language>.
        $included_languages = [
            'ar', 'bg', 'ca', 'zh-CN', 'zh-TW', 'hr', 'cs', 'da', 'nl',
            'en-GB', 'en', 'fil', 'fi', 'fr', 'fr-CA', 'de', 'de-AT', 'de-CH',
            'el', 'iw', 'hi', 'hu', 'id', 'it', 'ja', 'ko', 'lv', 'lt', 'no',
            'fa', 'pl', 'pt', 'pt-BR', 'pt-PT', 'ro', 'ru', 'sr', 'sk', 'sl',
            'es', 'es-419', 'sv', 'th', 'tr', 'uk', 'vi'
        ];

        $this->language =
            in_array($language, $included_languages) ? $language : 'en';

        $this->recaptcha = new \ReCaptcha\ReCaptcha($this->private_key);
    }

    /**
     * Print reCaptcha code.
     */
    public function printRecaptcha()
    {
        echo '
            <div class="g-recaptcha" data-sitekey="' . $this->public_key . '"></div>
            <script src="https://www.google.com/recaptcha/api.js?hl=' . $this->language . '"></script>
        ';
    }
}
