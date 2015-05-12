<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Log
 *
 * @author GFORTI
 */

namespace App\models\services;

use App\models\interfaces\ILogging;

class FileLogging implements ILogging {
    //put your code here
    
    private $logFiles = array(  "log" => 'logs/log.log.php',
                                "error" => 'logs/errors.log.php', 
                                "debug" => 'logs/debug.log.php', 
                                "exception" => 'logs/exception.log.php'
                            );
    
    private function _log($data, $type) {
        if ( is_string($data) && strlen($data) ) {
                $refID = uniqid();
                $dataLog = "\r\n[" . $refID . "]\t[" . $type . "]\t[" .date( "m-d-Y g:ia" ) . "]\t"  . $data;
               if (  error_log($dataLog, 3, $this->logFiles[$type]) ) {
                   return true;
               }
        }
        return false;
    }

    public function log($data) {
       return $this->_log($data, 'log');
    }
    
     public function logDebug($data) {
       return $this->_log($data, 'debug');
    }
   
     public function logException($data) {
       return $this->_log($data, 'exception');
    }
    
     public function logError($data) {
       return $this->_log($data, 'error');
    }
    
   
    
}
