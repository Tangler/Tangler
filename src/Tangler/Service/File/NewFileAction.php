<?php

namespace Tangler\Service\File;

use Tangler\Core\Interfaces\ActionInterface;
use Tangler\Core\ActionDescription;
use Tangler\Core\BaseAction;

class NewFileAction extends BaseAction
{
    public function init()
    {
        $this->setKey('new_file');
        $this->setLabel('New file action');
        $this->setDescription('This action creates a new file in a directory');
        
        $this->addField('absolutepath', 'Absolute path of the directory to place new files in');

        $this->addInput('filename', 'Name of the new file');
        $this->addInput('contents', 'Contents of the new file');
    }
}
