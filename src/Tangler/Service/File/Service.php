<?php

namespace Tangler\Service\File;

use Tangler\Core\BaseService;
use Tangler\Core\Interfaces\ServiceInterface;

class Service extends BaseService implements ServiceInterface
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
            new \Tangler\Service\File\NewFileAction()
        ));
    }
}
