<?php

namespace Tangler\Core;

class Channel extends AbstractDescription
{
    private $lastrunstamp;
    private $pollFrequency = 3;

    private $trigger;

    public function setTrigger($trigger)
    {
        $this->trigger = $trigger;
    }

    private $actions = array();
    public function addAction($action)
    {
        $this->actions[] = $action;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function Run()
    {
        echo "\nRunning " . $this->getLabel() . "\n";
        $this->lastrunstamp = time();
        $this->trigger->Poll($this);
    }

    public function timeToRun()
    {
        if (time()>($this->lastrunstamp+$this->pollFrequency)) {
            return true;
        }

        return false;
    }
}