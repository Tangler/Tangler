<?php

namespace Tangler\Core;

class Tangler
{
    private $channels;
    public function addChannel(Channel $channel)
    {
        $this->channels[] = $channel;
    }

    public function Run()
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
}