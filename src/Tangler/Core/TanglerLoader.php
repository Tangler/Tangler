<?php

namespace Tangler\Core;

use Tangler\Core\Tangler;
use Tangler\Core\Channel;
use SimpleXMLElement;

class TanglerLoader
{
    public function load(Tangler $tangler, $filename)
    {
        //TODO: Sanity checks
        $data = file_get_contents($filename);
        $xml = $movies = new SimpleXMLElement($data);
 
        foreach($xml->autoload as $autoloadnode)
        {
            $prefix = (string)$autoloadnode['prefix'];
            $path = (string)$autoloadnode['path'];

            echo "Adding autoload prefix: " . $prefix . ' (' . $path . ')' . "\n";
            $tangler->getAutoloader()->add($prefix, $path);
        }
        
        $registry = null;
        foreach($xml->registry as $registrynode)
        {
            $classname = (string)$registrynode['class'];
            $registry = new $classname();
            $parameters = array();
            foreach ($registrynode->parameter as $parameternode) {
                $key = (string)$parameternode['key'];
                $value = (string)$parameternode;

                $parameters[$key]=$value;
            }
            $registry->init($parameters);
        }

        if (!$registry) {
            $sqlitefilename = 'tangler.sqlite3';
            // [, int $mode = 0666 [, string &$error_message ]] )
            $parameters=array();
            $parameters['dsn']='sqlite:' . $sqlitefilename;
            $registry = new \Tangler\Core\PdoRegistry();
            $registry->init($parameters);
        }

        foreach ($xml->channel as $channelnode) {
            $channel = new Channel();
            $channel->setKey((string)$channelnode->key);
            $channel->setLabel((string)$channelnode->label);
            $channel->setDescription((string)$channelnode->description);

            foreach($channelnode->trigger as $triggernode) {
                $classname = (string)$triggernode['class'];
                $trigger = new $classname();
                $trigger->setRegistry($registry);

                foreach ($triggernode->parameter as $parameternode) {
                    $key = (string)$parameternode['key'];
                    $value = (string)$parameternode;
                    //TODO: ltrim line-by-line                    
                    $trigger->parameter->setValue($key, $value);
                }
                $channel->setTrigger($trigger);
            }

            foreach ($channelnode->action as $actionnode) {
                $classname = (string)$actionnode['class'];
                $action = new $classname();

                foreach ($actionnode->parameter as $actionnode) {
                    $key = (string)$actionnode['key'];
                    $value = (string)$actionnode;
                    //TODO: ltrim line-by-line
                    $action->parameter->setValue($key, $value);
                }
                $channel->addAction($action);
            }

            $tangler->addChannel($channel);
        }
    }
}