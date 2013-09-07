<?php

namespace Tangler\Module\File;

use Tangler\Core\AbstractModule;
use Tangler\Core\Interfaces\ModuleInterface;

class Module extends AbstractModule implements ModuleInterface
{
    public function init()
    {
        $this->setKey('file');
        $this->setLabel('File module');
        $this->setDescription('This is the local file and directory module');
        $this->setImageUrl('http://i.i.com.com/cnwk.1d/i/tim/2011/12/06/HardDriveIconX.png');

        $this->setTriggers(array(
            new \Tangler\Module\File\NewFileTrigger()
        ));

        $this->setActions(array(
            new \Tangler\Module\File\CreateFileAction()
        ));
    }
}
