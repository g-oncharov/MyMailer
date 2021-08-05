<?php

namespace App\Transport;


interface TransportInterface{

    /**
     * @param string $template
     * @param string $recipientMail
     * @param string $recipient
     * @param string $title
     * @param array $params
     * @return bool
     */
    public function send(string $template, string $recipientMail, string $recipient, string $title, array $params):bool;

    /**
     * @param string $pathLog
     * @param string $username
     * @return void
     */
    public function setLogs(string $pathLog, string $username):void;
}