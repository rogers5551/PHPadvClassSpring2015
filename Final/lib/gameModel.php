<?php

class gameModel implements IModel
{
    private $gameid;
    private $game;
    private $systemid;
    private $system;
    private $logged;
    private $lastupdated;
    private $active;
    
    function getGameid() {
        return $this->gameid;
    }

    function getGame() {
        return $this->game;
    }

    function getSystemid() {
        return $this->systemid;
    }
    
    function getSystem()
    {
        return $this->system;
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

    function setGameid($gameid) {
        $this->gameid = $gameid;
    }

    function setGame($game) {
        $this->game = $game;
    }

    function setSystemid($systemid) {
        $this->systemid = $systemid;
    }
    
    function setSystem($system)
    {
        $this->system = $system;
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
        if ( array_key_exists('gameid', $values) ) 
        {
            $this->setGameid($values['gameid']);
        }
        
        if ( array_key_exists('game', $values) )
        {
            $this->setGame($values['game']);
        }
        
        if ( array_key_exists('systemid', $values) )
        {
            $this->setSystemid($values['systemid']);
        }
        
        if ( array_key_exists('system', $values) ) {
            $this->setSystem($values['system']);
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
        $this->setGameid('');
        $this->setGame('');
        $this->setSystemid('');
        $this->setSystem('');
        $this->setLogged('');
        $this->setLastupdated('');
        $this->setActive('');
        return $this;
    }
}