<?php

namespace Tangler\Service\File;

use Tangler\Core\Interfaces\TriggerInterface;
use Tangler\Core\TriggerDescription;
use Tangler\Core\BaseTrigger;

class NewFileTrigger extends BaseTrigger
{
    public function init()
    {
        $this->setKey('new_file');
        $this->setLabel('New file trigger');
        $this->setDescription('This thing monitors a directory for new files');
        

        $this->addField('absolutepath', 'Absolute path of the directory to monitor');
        $this->addFilter('filename', 'Name of the file');

        $this->addOutput('filename', 'Name of the new file');
        $this->addOutput('createstamp', 'Create stamp of the file');
        $this->addOutput('contents', 'Contents of the new file');
    }
}
