<?php

namespace Tangler\Core;

use Tangler\Core\Interfaces\ModuleInterface;

class ModuleList
{
    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new ModuleList();
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