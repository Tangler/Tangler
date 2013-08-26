<?php

namespace Tangler\Module\Smtp;

use Tangler\Core\Interfaces\ActionInterface;
use Tangler\Core\AbstractAction;

use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;


class SendEmailAction extends AbstractAction implements ActionInterface
{
    public function Init()
    {
        $this->setKey('new_email');
        $this->setLabel('New email action');
        $this->setDescription('This action sends a new email');

        $this->parameter->defineParameter('smtp.host', 'string', 'SMTP Server hostname');
        $this->parameter->defineParameter('smtp.username', 'string', 'Username');
        $this->parameter->defineParameter('smtp.password', 'string', 'Password');
        $this->parameter->defineParameter('subject', 'string', 'Subject');
        $this->parameter->defineParameter('body', 'string', 'Body');
        $this->parameter->defineParameter('to', 'string', 'To address');
        $this->parameter->defineParameter('from', 'string', 'From address');
    }

    public function Run($input)
    {
        $smtphost = $this->resolveParameter('smtp.host', $input);
        $smtpusername = $this->resolveParameter('smtp.username', $input);
        $smtppassword = $this->resolveParameter('smtp.password', $input);
        $from = $this->resolveParameter('from', $input);
        $to = $this->resolveParameter('to', $input);
        $subject = $this->resolveParameter('subject', $input);
        $body = $this->resolveParameter('body', $input);

        echo "\n### SendEmailAction: [$from:$to]@$smtphost " . $subject . "\n";

        $transport = Swift_SmtpTransport::newInstance($smtphost, 25)
            ->setUsername($smtpusername)
            ->setPassword($smtppassword)
        ;

        $mailer = Swift_Mailer::newInstance($transport);
        $message = Swift_Message::newInstance($subject)
            ->setFrom(array($from => 'John Doe'))
            ->setTo(array($to => 'A name'))
            ->setBody($body)
        ;

        // Send the message
        $result = $mailer->send($message);
    }
}
