<?php

namespace Tangler\Core\Interfaces;

interface RegistryInterface
{
    public function init($parameters);
    public function setProcessed($base, $key);
    public function isProcessed($base, $key);
}