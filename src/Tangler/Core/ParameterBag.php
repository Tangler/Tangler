<?php

namespace Tangler\Core;

class ParameterBag
{
    private $parameter = array();

    public function defineParameter($key, $type, $label, $default = null)
    {
        if (isset($this->parameter[$key])) {
            throw new \InvalidArgumentException('Parameter already define in bag: ' . $key);
        }
        $parameter = new Parameter();
        $parameter->setKey($key);
        $parameter->setType($type);
        $parameter->setLabel($label);
        $parameter->setDefault($default);

        $this->parameter[$key] = $parameter;

    }

    public function setValue($key, $value)
    {
        if (!isset($this->parameter[$key])) {
            throw new \InvalidArgumentException('Parameter does not exist in bag (set): ' . $key);
        }
        $this->parameter[$key]->setValue($value);
    }

    public function getValue($key)
    {
        if (isset($this->parameter[$key])) {
            return $this->parameter[$key]->getValue();
        } else {
            throw new \InvalidArgumentException('Parameter does not exist in bag (get): ' . $key);
        }
    }

    public function get($key)
    {
        if (isset($this->parameter[$key])) {
            return $this->parameter[$key];
        } else {
            throw new \InvalidArgumentException('Parameter does not exist in bag (getParameter): ' . $key);
        }
    }    

}