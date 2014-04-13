<?php

namespace FRTemplate\Configuration;

/**
 * Present the database structure of the news section.
 */
class News
{
    const CONFIG_SECTION = 'News';

    public function __construct()
    {
        $ini = Base::getIni(self::CONFIG_SECTION);

        $this->table = $ini['table'];
        $this->dateColumn = $ini['date_column'];
        $this->titleColumn = $ini['title_column'];
        $this->bodyColumn = $ini['body_column'];
        $this->itemNumberTable = $ini['item_number_table'];
        $this->itemNumberColumn = $ini['item_number_column'];
        $this->sectionTitle = $ini['section_title'];
    }
}
