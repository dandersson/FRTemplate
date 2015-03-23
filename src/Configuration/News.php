<?php

namespace FRTemplate\Configuration;

/**
 * Present the database structure of the news section.
 */
class News extends Base
{
    public function __construct()
    {
        parent::__construct();

        $this->table = $this->ini['table'];
        $this->dateColumn = $this->ini['date_column'];
        $this->titleColumn = $this->ini['title_column'];
        $this->bodyColumn = $this->ini['body_column'];
        $this->itemNumberTable = $this->ini['item_number_table'];
        $this->itemNumberColumn = $this->ini['item_number_column'];
        $this->sectionTitle = $this->ini['section_title'];
    }
}
