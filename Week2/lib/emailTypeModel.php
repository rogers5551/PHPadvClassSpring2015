<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class emailTypeModel implements IModel
{
    private $emailtypeid;
    private $emailtype;
    private $active;
    
    function getEmailtypeid() {
        return $this->emailtypeid;
    }

    function getEmailtype() {
        return $this->emailtype;
    }

    function getActive() {
        return $this->active;
    }

    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }

    function setEmailtype($emailtype) {
        $this->emailtype = $emailtype;
    }

    function setActive($active) {
        $this->active = $active;
    }

    public function map(array $values) 
    {
        if ( array_key_exists('emailtypeid', $values) ) 
        {
            $this->setEmailtypeid($values['emailtypeid']);
        }
        
        if ( array_key_exists('emailtype', $values) )
        {
            $this->setEmailtype($values['emailtype']);
        }
        
        if ( array_key_exists('active', $values) )
        {
            $this->setActive($values['active']);
        }
        return $this;
    }

    public function reset()
    {
        $this->setEmailtypeid('');
        $this->setEmailtype('');
        $this->setActive('');
        return $this;
    }
}