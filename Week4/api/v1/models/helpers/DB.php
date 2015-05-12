<?php
/**
 * Description of DB
 *
 * @author GForti
 */

namespace API\models\services;
use API\models\interfaces\ILogging;
use \PDO;
use API\models\interfaces\IService;

class DB implements IService {
    
    protected $db = null;
    private $dbConfig = array();
    private $log = null;

    public function __construct($dbConfig, ILogging $log) {
        $this->setDbConfig($dbConfig);      
        $this->setLog($log);
    }
    
    private function getDbConfig() {
        return $this->dbConfig;
    }

    private function setDbConfig($dbConfig) {
        $this->dbConfig = $dbConfig;
    }
    
    private function getLog() {
        return $this->log;
    }

    private function setLog($log) {
        if ( $log instanceof ILogging) {
            $this->log = $log;
        }
        
    }

            
    public function getDB() { 
        if ( null != $this->db ) {
            return $this->db;
        }
        try {
            $config = $this->getDbConfig();
            $this->db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $ex) {
          $this->getLog()->log($ex->getMessage());
           $this->closeDB();
        }
        return $this->db;        
    }
    
     public function closeDB() {        
        $this->db = null;        
    }
    
    
}
