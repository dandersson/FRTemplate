<?php

namespace FRTemplate\DB;

/**
 * Database queries for news items.
 */
class News extends DBConnection
{
    public function __construct($language)
    {
        parent::__construct();
        $this->language = $language;
        $this->config = new \FRTemplate\Configuration\News();
    }

    /**
     * Return news items.
     */
    public function news()
    {
        $newsCount = $this->newsCount();
        $query = "
            SELECT
                {$this->config->dateColumn} AS date,
                {$this->config->titleColumn[$this->language]} AS title,
                {$this->config->bodyColumn[$this->language]} AS body
            FROM {$this->config->table}
            ORDER BY {$this->config->dateColumn}
            DESC LIMIT ?
            ";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $newsCount);
        $stmt->execute();
        $stmt->store_result();
        return $stmt;
    }

    /**
     * Return number of news items that are to be displayed.
     */
    private function newsCount()
    {
        $query = "
            SELECT {$this->config->itemNumberColumn}
            FROM {$this->config->itemNumberTable}
            LIMIT 1
            ";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_result($count);
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
        return $count;
    }
}
