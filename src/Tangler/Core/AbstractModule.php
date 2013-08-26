<?php

namespace Tangler\Core;

abstract class AbstractModule extends AbstractDescription
{
    private $accounttype;

    public function __construct()
    {
        $this->init();
    }

    public function setAccountType($accounttype)
    {
        $this->accounttype = $accounttype;
    }

    private $triggers = array();
    public function setTriggers($t)
    {
        $this->triggers = $t;
    }

    public function getTriggers()
    {
        return $this->triggers;
    }

    private $actions = array();
    public function setActions($a)
    {
        $this->actions = $a;
    }

    public function getActions()
    {
        return $this->actions;
    }

}