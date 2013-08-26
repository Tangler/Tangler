<?php

namespace Tangler\Module\File;

use Tangler\Core\Interfaces\TriggerInterface;
use Tangler\Core\AbstractTrigger;


class NewFileTrigger extends AbstractTrigger implements TriggerInterface
{
    public function Init()
    {
        $this->setKey('new_file');
        $this->setLabel('New file trigger');
        $this->setDescription('This thing monitors a directory for new files');

        $this->parameter->defineParameter('dir', 'string', 'Absolute path of the directory to monitor');

        $this->output->defineParameter('filename', 'string', 'Name of the new file');
        $this->output->defineParameter('createstamp', 'stamp', 'Create stamp of the file');
        $this->output->defineParameter('content', 'string', 'Contents of the new file');
    }


    public function Poll($channel)
    {
        $dir = $this->parameter->getValue('dir');
        echo "POLLING FOR NEW FILES in [" . $dir . "]\n";
        if (!is_dir($dir)) {
            // Path does not exist
            return false;
        }
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (is_file($dir . $file)) {

                    $content = file_get_contents($dir . $file);
                    $this->output->setValue('filename', $file);
                    $this->output->setValue('content', $content);
                    unlink($dir . $file);

                    foreach($channel->getActions() as $action) {
                        $action->Run($this->output);
                    }

                }
            }
            closedir($dh);
        }
    }
}
