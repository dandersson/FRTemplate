<?php

namespace FRTemplate\Configuration;

/**
 * Present site resources defined in the configuration.
 */
class Resources
{
    const CONFIG_SECTION = 'Resource';

    public function __construct()
    {
        $ini = Base::getIni(self::CONFIG_SECTION);

        $this->css = $ini['css'];

        $this->logoImg = $ini['logo_img'];
        $this->logoImgWidth = $ini['logo_img_width'];
        $this->logoImgHeight = $ini['logo_img_height'];
    }
}
