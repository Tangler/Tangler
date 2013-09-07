<?php

namespace Tangler\Module\File;

use Tangler\Core\Interfaces\ActionInterface;
use Tangler\Core\AbstractAction;

class CreateFileAction extends AbstractAction implements ActionInterface
{
    public function Init()
    {
        $this->setKey('new_file');
        $this->setLabel('New file action');
        $this->setDescription('This action creates a new file in a directory');

        $this->parameter->defineParameter('dir', 'string', 'Absolute path of the directory to put new files');
        $this->parameter->defineParameter('filename', 'string', 'Absolute path of the directory to put new files');
        $this->parameter->defineParameter('content', 'string', 'Absolute path of the directory to put new files');
    }

    public function Run($input)
    {
        $content = $this->resolveParameter('content', $input);
        $filename = $this->resolveParameter('filename', $input);
        $dir = $this->resolveParameter('dir', $input);
        echo "\n### CreateFileAction: [$dir] " . $filename;
        // . "\n$content\n";
        file_put_contents($dir . $filename, $content);
    }
}
