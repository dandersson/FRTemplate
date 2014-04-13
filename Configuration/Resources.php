<?php

namespace FRTemplate\Configuration;

/**
 * Present site resources defined in the configuration.
 */
class Resources extends Base
{
    const CONFIG_SECTION = 'Resource';

    public function __construct()
    {
        parent::__construct();

        $this->css = $this->ini[self::CONFIG_SECTION]['css'];

        $this->logoImg = $this->ini[self::CONFIG_SECTION]['logo_img'];
        $this->logoImgWidth = $this->ini[self::CONFIG_SECTION]['logo_img_width'];
        $this->logoImgHeight = $this->ini[self::CONFIG_SECTION]['logo_img_height'];

        unset($this->ini);
    }
}
