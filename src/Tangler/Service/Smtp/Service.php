<?php

namespace Tangler\Service\Smtp;

use Tangler\Core\AbstractService;
use Tangler\Core\Interfaces\ServiceInterface;

class Service extends AbstractService implements ServiceInterface
{
    public function init()
    {
        $this->setKey('smtp');
        $this->setLabel('Smtp service');
        $this->setDescription('This is the smtp service, it rocks!');

        // No triggers
        $this->setTriggers(array());

        $this->setActions(array(
            new \Tangler\Service\Smtp\SendEmailAction()
        ));
    }
}
