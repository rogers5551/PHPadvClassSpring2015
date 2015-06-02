<?php

class Validator {

    public function gameIsValid($game) {
        return ( is_string($game) && !empty($game) );
    }
    
    public function systemIsValid($game) {
        return ( is_string($game) && !empty($game) );
    }
    
    public function activeIsValid($type) {
        return ( is_string($type) && preg_match("/^[0-1]$/", $type) );
    }

}
