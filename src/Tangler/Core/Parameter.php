<?php

namespace Tangler\Core;

class Parameter
{
    private $key;
    private $value;
    private $type;
    private $label;
    private $default;

    public function getKey()
    {
        return $this->key;
    }


    public function setKey($key)
    {
        $this->key = $key;
    }

    public function getValue()
    {
        return $this->value;
    }


    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getType()
    {
        return $this->type;
    }


    public function setType($type)
    {
        $this->type = $type;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }


    public function getDefault()
    {
        return $this->default;
    }

    public function setDefault($default)
    {
        $this->default = $default;
    }

}