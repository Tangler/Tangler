<?php

namespace Tangler\Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ServiceDescribeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('service:describe')
            ->setDescription('Output service description')
            ->addArgument(
                'servicekey',
                InputArgument::REQUIRED,
                'Key of the service'
            )
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $key = $input->getArgument('servicekey');
        $services = $this->getApplication()->services;
        foreach ($services as $service) {
            if ($service->getKey() == $key) {
                $this->describeService($service, $output);
            }
        }

    }

    private function describeService($service, $output)
    {
        print_r($service);
    }
}
