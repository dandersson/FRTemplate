<?php

namespace FRTemplate;

use FRTemplate\Constants\Email as CSE;

/**
 * Utilities for creating an e-mail form.
 */
class EmailForm
{
    /**
     * Setup default form values based on previous user submissions and present
     * localized form strings.
     */
    public function __construct($language)
    {
        $this->config = new Configuration\EmailForm($language);

        // Status message handling. CSE::CURL_FAIL uses GET since if Curl has
        // failed, we can't generate POST messages anyway.
        if (isset($_GET[CSE::EMAIL_STATUS])) {
            $this->status = $_GET[CSE::EMAIL_STATUS];
        } elseif (isset($_POST[CSE::EMAIL_STATUS])) {
            $this->status = $_POST[CSE::EMAIL_STATUS];
        }

        $this->name = isset($_POST[CSE::NAME]) ? $_POST[CSE::NAME] : '';
        $this->replyto = isset($_POST[CSE::REPLYTO]) ? $_POST[CSE::REPLYTO] : '';
        $this->subject = isset($_POST[CSE::SUBJECT]) ? $_POST[CSE::SUBJECT] : '';
        $this->body = isset($_POST[CSE::BODY]) ? $_POST[CSE::BODY] : '';
    }

    /**
     * Print localized status message corresponding to the current status.
     */
    public function statusMessage()
    {
        echo $this->config->status[$this->status];
    }
}
