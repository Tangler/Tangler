<?php

namespace Tangler\Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tangler\Core\Tangler;
use Tangler\Core\TanglerLoader;
use Tangler\Core\Channel;

class RunFileCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('run:file')
            ->setDescription('Runs tangler engine with data from specified file')
            ->addArgument(
                'filename',
                InputArgument::REQUIRED,
                'Filename of XML tangler config file'
            )
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $services = $this->getApplication()->services;

        $tangler = new Tangler();
        $loader = new TanglerLoader();

        $filename = $input->getArgument('filename');
        $loader->load($tangler, $filename);

        
        /*

        $channel = new Channel();
        $channel->setKey('test.channel.label');
        $channel->setLabel('Test channel label');
        $channel->setDescription('Test channel description');

        $trigger = new \Tangler\Service\File\NewFileTrigger();
        $trigger->parameter->setValue('dir', '/tmp/tangler.in/');

        $channel->setTrigger($trigger);

        $action = new \Tangler\Service\File\CreateFileAction();
        $action->parameter->setValue('dir', '/tmp/tangler.out/');
        $action->parameter->setValue('filename', 'new.{{filename}}.bin');
        $action->parameter->setValue('content', 'Content: {{content}}.the end');
        $channel->addAction($action);

        $action = new \Tangler\Service\Smtp\SendEmailAction();
        $action->parameter->setValue('smtp.host', 'mail.example.web');
        $action->parameter->setValue('smtp.username', 'qweqweqwe');
        $action->parameter->setValue('smtp.password', 'qweqweqwe');
        $action->parameter->setValue('subject', 'New file: {{filename}}');
        $action->parameter->setValue('from', 'me@example.web');
        $action->parameter->setValue('to', 'you@example.web');
        $action->parameter->setValue('body', "Found a file {{filename}}:\n{{content}}\nThe end!");
        $channel->addAction($action);

        $tangler->addChannel($channel);
        

        */
        $tangler->Run();
        
    }
}
