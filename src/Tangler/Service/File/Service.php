<?php

namespace Tangler\Service\File;

use Tangler\Core\AbstractService;
use Tangler\Core\Interfaces\ServiceInterface;

class Service extends AbstractService implements ServiceInterface
{
    public function init()
    {
        $this->setKey('file');
        $this->setLabel('File service');
        $this->setDescription('This is the file service, it rocks!');
        $this->setAccountType('twitter');

        $this->setTriggers(array(
            new \Tangler\Service\File\NewFileTrigger()
        ));

        $this->setActions(array(
            new \Tangler\Service\File\CreateFileAction()
        ));
    }
}
