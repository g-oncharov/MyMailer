<?php
namespace App\Transport;

use App\View\View;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class MailTransport implements TransportInterface {
    public $config;
    public $log;
    public $logIsSet;

    public function __construct(array $arr)
    {
        $this->config = $arr;
        $this->logIsSet = false;
    }

    public function setLogs(string $pathLog, string $username):void
    {
        $this->log = new Logger($username);
        $formatter = new JsonFormatter();
        $stream = new StreamHandler($pathLog, Logger::DEBUG);
        $stream->setFormatter($formatter);
        $this->log->pushHandler($stream);
        $this->logIsSet = true;
    }


    public function send(string $template, string $recipientMail, string $recipient, string $title, array $params): bool
    {
        $view = new View();
        $result = false;
        extract($this->config);
        extract($params);

        $template = $pathTemplates . $template .'.php';

        $body = $view->render($template, $defaultTemplate, $params);

        $transport = (new Swift_SmtpTransport($smtp, $port, $encryption))
            ->setUsername($email)
            ->setPassword($password);

        $mailer = new Swift_Mailer($transport);
        $message = (new Swift_Message($title))
            ->setContentType("text/html")
            ->setFrom([$email => $username])
            ->setTo([$recipientMail => "$recipient"])
            ->setBody("$body", 'text/html');

        try {
            (bool)$result = $mailer->send($message);
        } catch (\Exception $exception) {
            if ($this->logIsSet) {
                $this->log->error('Error',[$exception]);
            }
        }
        return $result;
    }
}