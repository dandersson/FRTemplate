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

        $this->lib = $config->libdir . '/recaptchalib.php';
        $this->public_key = $config->public_key;
        $this->private_key = $config->private_key;
        $this->theme = $config->theme;

        $language_file = $config->libdir . "/languages/$language.php";
        $this->translationFile =
            file_exists($language_file) ? $language_file : NULL;

        // Natively supported languages from
        // <https://developers.google.com/recaptcha/docs/customization>.
        $included_languages = ['en', 'nl', 'fr', 'de', 'pt', 'ru', 'es', 'tr'];

        $this->language =
            in_array($language, $included_languages) ? $language : NULL;

        require $this->lib;
    }

    /**
     * Print options and reCaptcha code.
     */
    public function printRecaptcha()
    {
        $this->printOptions();
        echo recaptcha_get_html($this->public_key);
    }

    /**
     * Print reCaptcha options. Option reference available at
     * <https://developers.google.com/recaptcha/docs/customization>
     */
    private function printOptions()
    {
        $options = array_filter([
            $this->optionLanguage(),
            $this->optionTheme(),
            $this->optionTranslation()
        ]);

        if ($options) {
            echo "<script>\nvar RecaptchaOptions = {\n" .
                implode(",\n", $options) .
                "\n};\n</script>\n";
        }
    }

    /**
     * Generate language option.
     */
    private function optionLanguage()
    {
        return $this->language !== NULL ?
            "lang: '{$this->language}'" :
            NULL;
    }

    /**
     * Generate theme option.
     */
    private function optionTheme()
    {
        return $this->theme !== NULL ?
            "theme : '{$this->theme}'" :
            NULL;
    }

    /**
     * Generate custom translation option.
     */
    private function optionTranslation()
    {
        return $this->translationFile !== NULL ?
            "custom_translations : {\n" .
            file_get_contents($this->translationFile) .
            "}" :
            NULL;
    }
}
