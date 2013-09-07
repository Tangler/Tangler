<?php

namespace Tangler\Core;

abstract class AbstractModule extends AbstractDescription
{
    private $accounttype;

    public function __construct()
    {
        $this->init();
    }

    public function setAccountType($accounttype)
    {
        $this->accounttype = $accounttype;
    }

    private $triggers = array();
    public function setTriggers($t)
    {
        $this->triggers = $t;
    }

    public function getTriggers()
    {
        return $this->triggers;
    }

    private $actions = array();
    public function setActions($a)
    {
        $this->actions = $a;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function getFormItem($label, $value)
    {
        $o = '';
        $o .= "<div class=\"formitem\">";
        $o .= "<label>$label</label>\n";
        $o .= "<span class=\"value\">" . $value . "</span></div>\n";
        return $o;

    }

    public function getHtml()
    {
        $o = '';
        $o .= '<img src="' . $this->getImageUrl() . '" class="docimage" />';
        $o .= "<h1>" . $this->getLabel() . "</h1>\n";
        $o .= $this->getFormItem('Description', $this->getDescription());
        $o .= $this->getFormItem('Key', $this->getKey());
        $o .= $this->getFormItem('Classname', get_class($this));

        
        foreach ($this->getTriggers() as $trigger)
        {
            $o .= "<h2>Trigger: " . $trigger->getLabel() . "</h3>\n";
            $o .= $this->getFormItem('Description', $trigger->getDescription());
            $o .= $this->getFormItem('Key', $trigger->getKey());
            $o .= $this->getFormItem('Classname', get_class($trigger));
            $status = $trigger->getStatus();
            if ($status != '') {
                $o .= $this->getFormItem('Status', $status);
            }

            $o .= "<ul>\n";

            foreach ($trigger->parameter->getAll() as $parameter) {
                $o .= "<li><code>" . $parameter->getKey() . "</code> (" . $parameter->getType() . "): " . $parameter->getLabel() . "</li>\n";
            }
            $o .= "</ul>\n";

        }

        
        foreach ($this->getActions() as $action)
        {

            $o .= "<h2>Action: " . $action->getLabel() . "</h2>\n";
            $o .= $this->getFormItem('Description', $action->getDescription());
            $o .= $this->getFormItem('Key', $action->getKey());
            $o .= $this->getFormItem('Classname', get_class($action));
            $status = $action->getStatus();
            if ($status != '') {
                $o .= $this->getFormItem('Status', $status);
            }

            $o .= "<ul>\n";

            foreach ($action->parameter->getAll() as $parameter) {
                $o .= "<li><code>" . $parameter->getKey() . "</code> (" . $parameter->getType() . "): " . $parameter->getLabel() . "</li>\n";
            }
            $o .= "</ul>\n";

        }

        return $o;
    }

    public function getIndexHtml()
    {
        $o = '<div class="moduleentry">';
        $o .= '<a href="module-' . $this->getKey() . '">';
        $o .= '<img src="' . $this->getImageUrl() . '" class="indeximage" /></a>';

        $o .= '<a href="module-' . $this->getKey() . '">';
        $o .= '<h1>' . $this->getLabel() . '</h1></a>';
        $o .= '<p>' .  $this->getDescription() . '</p>';
        $o .= '<ul>';
        foreach ($this->getTriggers() as $trigger)
        {
            if ($o)
            $o .= '<li>Trigger: ' . $trigger->getLabel() . $details . '</li>';
        }
        foreach ($this->getActions() as $action)
        {

            $o .= '<li>Action: ' . $action->getLabel() . $details . '</li>';
        }
        $o .= '</ul>';

        $o .= '</div>';
        return $o;
    }
}