<?php

/**
 * Create schema in mysql like this:
 *
 * create table tangler_registry (basename varchar(255), keyname varchar(255));
 * 
 */

namespace Tangler\Core;

use Tangler\Core\Interfaces\RegistryInterface;
use \PDO;

class PdoRegistry implements RegistryInterface
{
    private $pdo;

    public function init($parameters)
    {
        $dsn = $parameters['dsn'];
        $username = $parameters['username'];
        $password = $parameters['password'];
        echo "CONNECTING TO " . $dsn;

        $this->pdo = new PDO($dsn, $username, $password);
        if (!$this->pdo) {
            throw new \RuntimeException('Failed to init PdoRegistry');
        }

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS tangler_registry (
                    id INTEGER PRIMARY KEY, 
                    basename varchar(255), 
                    keyname varchar(255))");
    }

    public function setProcessed($base, $key)
    {
        $sql = 'INSERT INTO tangler_registry (basename, keyname) VALUES (:base,:key);';
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(':base' => $base,':key' => $key));

    }

    public function isProcessed($base, $key)
    {
        $sql = 'SELECT keyname FROM tangler_registry WHERE basename=:base AND keyname=:key';
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(':base' => $base,':key' => $key));
        $res = $sth->fetchAll();

        // echo "KEY:$key PROCESSED: " . count($res) . " times!\n";

        if (count($res)>0) {
            return true;
        }
        return false;

    }
}