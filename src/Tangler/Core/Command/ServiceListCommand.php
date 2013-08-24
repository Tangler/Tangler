<?php

namespace Tangler\Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServiceListCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('service:list')
            ->setDescription('List available services')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $services = $this->getApplication()->services;
        foreach ($services as $service) {
            echo $service->getKey() . ":" . $service->getLabel() . "\n";
        }
    }
}
