<?php

namespace Tangler\Core;

abstract class AbstractTrigger extends AbstractDescription
{
    public $parameter;
    public $output;

    public function __construct()
    {
        $this->parameter = new ParameterBag();
        $this->output = new ParameterBag();
        $this->init();
    }
}
