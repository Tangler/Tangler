<?php


namespace Tangler\Core;

use Tangler\Core\Interfaces\RegistryInterface;

abstract class AbstractTrigger extends AbstractDescription
{
    public $parameter;
    public $output;

    private $registry;
    private $registrybase;

    public function __construct()
    {
        $this->parameter = new ParameterBag();
        $this->output = new ParameterBag();
        $this->registrybase = get_class($this);
        $this->init();
    }

    public function getRegistry()
    {
        return $this->registry;
    }


    public function setRegistry(RegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    public function isProcessed($key)
    {
        return $this->getRegistry()->isProcessed($this->registrybase, $key);
    }

    public function setProcessed($key)
    {
        $this->getRegistry()->setProcessed($this->registrybase, $key);
    }


}
