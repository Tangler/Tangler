<?php

namespace Tangler\Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ModuleListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('module:list')
            ->setDescription('List available modules')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $modules = $this->getApplication()->modules;
        foreach ($modules as $module) {
            echo $module->getKey() . ":" . $module->getLabel() . "\n";
        }
    }
}
