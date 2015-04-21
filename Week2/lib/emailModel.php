<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class emailModel implements IModel
{
    private $emailid;
    private $email;
    private $emailtypeid;
    private $emailtype;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getEmailid() {
        return $this->emailid;
    }

    function getEmail() {
        return $this->email;
    }

    function getEmailtypeid() {
        return $this->emailtypeid;
    }
    
    function getEmailtype()
    {
        return $this->emailtype;
    }

    function getLogged() {
        return $this->logged;
    }

    function getLastupdated() {
        return $this->lastupdated;
    }

    function getActive() {
        return $this->active;
    }

    function setEmailid($emailid) {
        $this->emailid = $emailid;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEmailtypeid($emailtypeid) {
        $this->emailtypeid = $emailtypeid;
    }
    
    function setEmailtype($emailtype)
    {
        $this->emailtype = $emailtype;
    }

    function setLogged($logged) {
        $this->logged = $logged;
    }

    function setLastupdated($lastupdated) {
        $this->lastupdated = $lastupdated;
    }

    function setActive($active) {
        $this->active = $active;
    }

    
    public function map(array $values) 
    {
        if ( array_key_exists('emailid', $values) ) 
        {
            $this->setEmailid($values['emailid']);
        }
        
        if ( array_key_exists('email', $values) )
        {
            $this->setEmail($values['email']);
        }
        
        if ( array_key_exists('emailtypeid', $values) )
        {
            $this->setEmailtypeid($values['emailtypeid']);
        }
        
        if ( array_key_exists('emailtype', $values) ) {
            $this->setEmailtype($values['emailtype']);
        }
        
        if ( array_key_exists('logged', $values) ) 
        {
            $this->setLogged($values['logged']);
        }
        
        if ( array_key_exists('lastupdated', $values) )
        {
            $this->setLastupdated($values['lastupdated']);
        }
        
        if ( array_key_exists('active', $values) )
        {
            $this->setActive($values['active']);
        }
        return $this;
    }

    public function reset()
    {
        $this->setEmailid('');
        $this->setEmail('');
        $this->setEmailtypeid('');
        $this->setEmailtype('');
        $this->setLogged('');
        $this->setLastupdated('');
        $this->setActive('');
        return $this;
    }
}