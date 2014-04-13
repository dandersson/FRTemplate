<?php

namespace FRTemplate\Configuration;

/**
 * Present the database structure of the news section.
 */
class News extends Base
{
    const CONFIG_SECTION = 'News';

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->ini[self::CONFIG_SECTION]['table'];
        $this->dateColumn = $this->ini[self::CONFIG_SECTION]['date_column'];
        $this->titleColumn = $this->ini[self::CONFIG_SECTION]['title_column'];
        $this->bodyColumn = $this->ini[self::CONFIG_SECTION]['body_column'];
        $this->itemNumberTable = $this->ini[self::CONFIG_SECTION]['item_number_table'];
        $this->itemNumberColumn = $this->ini[self::CONFIG_SECTION]['item_number_column'];
        $this->sectionTitle = $this->ini[self::CONFIG_SECTION]['section_title'];
    }
}
