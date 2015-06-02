<?php

class Util {
    
    public function isPostRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
    }
      
    public function isGetRequest() {
        return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
    }
    
    public function isLoggedin() {
        return ( isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true );
    }
    
    public function setLoggedin($value) {
        $_SESSION['loggedin'] = $value;
    }
    
    public function logOut()
    {
        unset($_SESSION['loggedin']);
    }
    
    public function createLink($page, array $params = array()) {        
        return $page . '?' .http_build_query($params);
    }
    
    public function redirect($page, array $params = array()) {
        header('Location: ' . $this->createLink($page, $params));
        die();
    }
    
}