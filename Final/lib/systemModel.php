<?php

class systemModel implements IModel
{
    private $systemid;
    private $system;
    private $active;
    
    function getSystemid() {
        return $this->systemid;
    }

    function getSystem() {
        return $this->system;
    }

    function getActive() {
        return $this->active;
    }

    function setSystemid($systemid) {
        $this->systemid = $systemid;
    }

    function setSystem($system) {
        $this->system = $system;
    }

    function setActive($active) {
        $this->active = $active;
    }

    public function map(array $values) 
    {
        if ( array_key_exists('systemid', $values) ) 
        {
            $this->setSystemid($values['systemid']);
        }
        
        if ( array_key_exists('system', $values) )
        {
            $this->setSystem($values['system']);
        }
        
        if ( array_key_exists('active', $values) )
        {
            $this->setActive($values['active']);
        }
        return $this;
    }

    public function reset()
    {
        $this->setSystemid('');
        $this->setSystem('');
        $this->setActive('');
        return $this;
    }
}