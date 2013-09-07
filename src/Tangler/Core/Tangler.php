<?php

namespace Tangler\Core;

class Tangler
{
    private $channels;
    private $autoloader;

    public function addChannel(Channel $channel)
    {
        $this->channels[] = $channel;
    }

    public function run()
    {
        while(1) {
            foreach ($this->channels as $channel) {
                if ($channel->timeToRun()) {
                    $channel->Run();
                }
            }
            sleep(1);
            echo '.';
        }
    }


    public function setAutoloader($autoloader)
    {
        $this->autoloader = $autoloader;
    }


    public function getAutoloader()
    {
        return $this->autoloader;
    }
}