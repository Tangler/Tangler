<?php

namespace Tangler\Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tangler\Core\Tangler;
use Tangler\Core\Channel;
use SimpleXMLElement;

class DocumentationGenerateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('documentation:generate')
            ->setDescription('Generates tangler module documentation')
            ->addArgument(
                'filename',
                InputArgument::REQUIRED,
                'Filename of XML tangler documentation config file'
            )
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tangler = new Tangler();
        $tangler->setAutoloader($this->getApplication()->autoloader);

        $filename = $input->getArgument('filename');

        $data = file_get_contents($filename);
        $xml = $movies = new SimpleXMLElement($data);
 
        foreach($xml->autoload as $autoloadnode)
        {
            $prefix = (string)$autoloadnode['prefix'];
            $path = (string)$autoloadnode['path'];

            echo "Adding autoload prefix: " . $prefix . ' (' . $path . ')' . "\n";
            $tangler->getAutoloader()->add($prefix, $path);
        }

        $indexhtml = '<h1>Module index</h1>';

        foreach($xml->moduledoc as $moduledocnode)
        {
            $classname = (string)$moduledocnode['class'];
            $output = (string)$moduledocnode['output'];
            //echo "CLASS: $classname\n";
            $module = new $classname();
            $html = $module->getHtml();
            $indexhtml .= $module->getIndexHtml();

            $data=array();
            $data['body'] = $html;
            file_put_contents($output, json_encode($data));
        }

        $data=array();
        $data['body'] = $indexhtml;
        file_put_contents('contents/modules.json', json_encode($data));

        
    }
}
