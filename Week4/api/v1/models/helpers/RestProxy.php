<?php

/**
 * Description of RestConsume
 *
 * @author User
 */

namespace API\models\services;

use API\models\interfaces\IService;

class RestProxy implements IService {
    
    private $status_codes = array(  
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Access Forbidden',
            404 => 'Not Found',
            409 => 'Conflict',
            500 => 'Internal Server Error',
        );
     
        
    protected function setHeaders($status = 200) {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");
        header("Content-Type: application/json");
        
        header("HTTP/1.1 " . $status . " " . $this->getStatusMessage($status));
    }
    
    protected function getStatusMessage($code) {
        return ( isset($this->status_codes[$code]) ? $this->status_codes[$code] : $this->status_codes[500] );
    }
    
    public function callAPI($method, $url, $data = false, $auth = "") {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                //curl_setopt($curl, CURLOPT_PUT, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                 if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                 }
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
        }

        // Optional Authentication:
        if ( !empty($auth) ) {
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_USERPWD, $auth);
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        curl_close($curl);
       
        $this->setHeaders($httpCode);
        echo $result;
    }
     
     
    
    public function getHTTPVerb() { 
        return filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    }
    
    
    public function getHTTPData() {
        $data = array();
        
        $verb = $this->getHTTPVerb();
                
        switch($verb) {
            case 'DELETE':
            case 'POST':
                $data = filter_input_array(INPUT_POST);
                break;
            case 'GET':
                $data = filter_input_array(INPUT_GET);
                break;
            case 'PUT':
                parse_str(file_get_contents('php://input'), $data);            
                break;       
        }
       
        return $data;
    }
     
    
    public function endpoint($url) {
        return $url.DIRECTORY_SEPARATOR.filter_input(INPUT_GET, 'resource');        
    }
    
    
    public function getOrigin() {
        // Requests from the same server don't have a HTTP_ORIGIN header
        return ( NULL !== filter_input(INPUT_SERVER, 'HTTP_ORIGIN') ? filter_input(INPUT_SERVER, 'HTTP_ORIGIN') : filter_input(INPUT_SERVER, 'SERVER_NAME') );        
    }
     
}
