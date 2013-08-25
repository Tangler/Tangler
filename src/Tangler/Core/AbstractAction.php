<?php

namespace Tangler\Core;

abstract class AbstractAction extends AbstractDescription
{
    public $parameter;

    public function __construct()
    {
        $this->parameter = new ParameterBag();
        $this->init();
    }

    public function resolveParameter($key, ParameterBag $input)
    {
        $value = $this->parameter->getValue($key);
//echo "ORGVALUE: $value";
        $pattern = '/\{\{(.*?)\}\}/';
        preg_match_all($pattern, $value, $matches, PREG_SET_ORDER, 0);
        
        foreach ($matches as $m) {
            $container=$m[0];
            $content=$m[1];

            $data = $input->getValue($content);
            //echo "New data: $content=$data\n";
            //print_r($this->parameter);
            $value = str_replace($container, $data, $value);

            //echo "content: " . $content . "::container=$container\n";
        }

        return $value;

    }
}
