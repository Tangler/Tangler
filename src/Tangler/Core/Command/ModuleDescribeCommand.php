<?php

namespace Tangler\Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ModuleDescribeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('module:describe')
            ->setDescription('Output module description')
            ->addArgument(
                'modulekey',
                InputArgument::REQUIRED,
                'Key of the module'
            )
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $key = $input->getArgument('modulekey');
        $modules = $this->getApplication()->modules;
        foreach ($modules as $module) {
            if ($module->getKey() == $key) {
                $this->describeService($module, $output);
            }
        }

    }

    private function describeService($module, $output)
    {
        print_r($module);
    }
}
