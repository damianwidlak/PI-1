<?php

namespace Nieruchomosci\Model;

use Laminas\Mail\Transport\Smtp as SmtpTransport;
use Laminas\Mail\Transport\SmtpOptions;
use Laminas\Mail\Message;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Mime\Part as MimePart;

class Zapytanie
{
    private $smtpTransportConfig;
    private $from;

    public function __construct(array $config)
    {
        $this->from = $config['from'];
        unset($config['from']);

        $this->smtpTransportConfig = $config;
    }

    public function wyslij($daneOferty, $tresc)
    {
        $transport = new SmtpTransport();
        $options = new SmtpOptions($this->smtpTransportConfig);
        $transport->setOptions($options);

        $part = new MimePart("Klient wyraził zainteresowanie ofertą numer *$daneOferty[numer]* o treści:\n\n$tresc");
        $part->type = 'text/plain';
        $part->charset = 'utf-8';

        $body = new MimeMessage();
        $body->setParts([$part]);

        $message = new Message();
        $message->setEncoding('UTF-8');
        $message->setFrom($this->from['email'], $this->from['name']); // konto do wysyłania maili z serwisu
        $message->addTo('konto@wit.edu.pl', "Odbiorca"); // osoba obsługująca zgłoszenia
        $message->setSubject("Zainteresowanie ofertą");
        $message->setBody($body);

        try {
            $transport->send($message);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}
