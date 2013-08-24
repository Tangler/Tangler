<?php

namespace Tangler\Core;

use Tangler\Core\Interfaces\ServiceInterface;

class ServiceList
{
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ServiceList();
        }
        return self::$instance;
    }

    private $classes = array();
    public function addClass($classname) {
        $this->classes[] = $classname;
    }

    public function getClasses()
    {
        return $this->classes;
    }
}