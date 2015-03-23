<?php

namespace FRTemplate;

use FRTemplate\Constants\Email as CSE;
use FRTemplate\Constants\Recaptcha as CSR;

/**
 * Utilities for sending email via a web form.
 */
class Email
{
    /**
     * Define language and return page after actions to initiate object.
     */
    public function __construct($language, $return_page)
    {
        isset($_POST[CSE::SUBMIT]) or header("Location: $return_page");

        $this->language = $language;
        $this->returnPage = $return_page;
        $config = new Configuration\Email();
        $this->destination = $config->destination;
        $this->setEmailParameters();
    }

    /**
     * Send email after a blacklist check on body content.
     */
    public function send()
    {
        empty($this->body) and $this->returnToPage(CSE::EMAIL_EMPTY);
        $this->recaptchaCheckText($_POST[CSE::BODY]);

        // Only if the e-mail server does not respond at all, the die() clause
        // will be triggered. In case the e-mail can't be sent due to
        // circumstances later in the chain, the e-mail server is responsible
        // for error handling.
        mail($this->destination, $this->subject, $this->body, $this->header) or
            die($this->returnToPage(CSE::EMAIL_FAIL));

        $this->returnToPage(CSE::EMAIL_OK);
    }

    /**
     * Build headers and e-mail content from user supplied data.
     */
    private function setEmailParameters()
    {
        // Strip newlines from the header to protect against header injection
        // (<http://www.phpsecure.info/v2/article/MailHeadersInject.en.php>).
        $replyto = str_replace(array('\r', '\n'), '', $_POST[CSE::REPLYTO]);

        $this->header = implode("\r\n", [
                'From: ' . $replyto,
                'Reply-To: ' . $replyto,
                'MIME-Version: 1.0',
                'Content-type: text/plain; charset=utf-8',
                'Content-Transfer-Encoding: 8bit',
                'X-Originating-IP: ' . $_SERVER['REMOTE_ADDR'],
                'X-Site-Language-Version: ' . $this->language]);

        // To enable non-ASCII characters in the subject in a robust manner,
        // base64 encoded UTF-8 seems to be the way to go.
        $this->subject = '=?UTF-8?B?' .
            base64_encode($_POST[CSE::NAME] . ': ' . $_POST[CSE::SUBJECT]) .
            '?=';
        $this->body = wordwrap($_POST[CSE::BODY], 70);
    }

    /**
     * Decide if text content is deemed spammy.
     */
    private function isSpamLike($text)
    {
        // Messages that contain links correspond quite well to spam bots.

        // Need strict type comparison here. See the manual:
        // <http://php.net/function.stripos>.
        return (
            stripos($text, 'http') !== false ||
            stripos($text, 'href') !== false
        );
    }

    /**
     * Perform reCaptcha test if text is deemed spam-like.
     */
    private function recaptchaCheckText($text)
    {
        // If someone really wants to spam, there is not much hindering them
        // since the have the e-mail address anyway. To counter bots trying to
        // abuse the form, reCAPTCHA <http://www.google.com/recaptcha>
        // validation is forced upon messages that are deemed spam like.
        $sleep_time = 5;
        // Need strict type comparison here. See the manual:
        // <http://php.net/function.stripos>.
        if ($this->isSpamLike($text)) {
            if (isset($_POST[CSR::RESPONSE_FIELD])) {
                $recaptcha = new \FRTemplate\Recaptcha();
                $recaptcha_answer = $recaptcha->recaptcha->verify(
                    $_POST[CSR::RESPONSE_FIELD],
                    $_SERVER['REMOTE_ADDR']
                );
                if (!$recaptcha_answer->isSuccess()) {
                    sleep($sleep_time);
                    $this->returnToPage(CSE::RECAPTCHA_FAIL);
                }
            } else {
                sleep($sleep_time);
                $this->returnToPage(CSE::SPAM_TEST);
            }
        }
    }

    /**
     * Utility function to test if this class has requested a reCaptcha test.
     */
    public static function isRecaptchaRequested()
    {
        return (
            isset($_POST[CSE::EMAIL_STATUS]) &&
            (
                $_POST[CSE::EMAIL_STATUS] === CSE::SPAM_TEST ||
                $_POST[CSE::EMAIL_STATUS] === CSE::RECAPTCHA_FAIL
            )
        );
    }

    /**
     * Utility function to return to page with e-mail data intact for the user.
     */
    private function returnToPage($status)
    {
        $post_return = [
            CSE::NAME => $_POST[CSE::NAME],
            CSE::REPLYTO => $_POST[CSE::REPLYTO],
            CSE::SUBJECT => $_POST[CSE::SUBJECT],
            CSE::BODY => $_POST[CSE::BODY],
            CSE::EMAIL_STATUS => $status
        ];

        // Note that GET parameters come with several limitations in length in
        // different browsers (around <500 characters for an URL string). That
        // is an additional reason that cURL is used, above that POST data is
        // more natural for the task in general.
        $curl_handle = curl_init();

        curl_setopt(
            $curl_handle,
            CURLOPT_URL,
            URL::fullBaseURL() . '/' . $this->returnPage
        );
        curl_setopt($curl_handle, CURLOPT_POST, count($post_return));
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $post_return);

        // Use URL::addHttpQuery to handle non-`mod_rewrite` setups
        // transparently, as well as (unlikely) anchor links.
        curl_exec($curl_handle) or
            die(
                header('Location: ' .
                    URL::addHttpQuery(
                        $this->returnPage,
                        http_build_query([CSE::EMAIL_STATUS => CSE::CURL_FAIL]
                        )
                    )
                )
            );
        curl_close($curl_handle);
        exit;
    }
}
