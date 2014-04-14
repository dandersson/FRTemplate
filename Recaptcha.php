<?php

namespace FRTemplate;

use Constants\Recaptcha as CSR;

/**
 * Initiate reCaptcha interface.
 */
class Recaptcha
{
    public function __construct()
    {
        $config = new Configuration\Recaptcha();

        $this->lib = $config->libdir . '/recaptchalib.php';
        $this->public_key = $config->public_key;
        $this->private_key = $config->private_key;
        $this->theme = $config->theme;

        require $this->lib;
    }

    public function printRecaptcha()
    {
        $this->printOptions();
        echo recaptcha_get_html($this->public_key);
    }

    private function printOptions()
    {
        $options = array_filter([
            $this->optionTheme()
        ]);

        if ($options) {
            echo "<script>\nvar RecaptchaOptions = {\n" .
                implode(",\n", $options) .
                "\n};\n</script>\n";
        }
    }

    private function optionTheme()
    {
        return $this->theme !== NULL ?
            "theme : '{$this->theme}'" :
            NULL;
    }
}
