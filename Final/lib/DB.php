<?php
class DB {
    
    protected $db = null;
    private $dbConfig = array();
   
    public function __construct($dbConfig) {
        $this->setDbConfig($dbConfig);      
    }
    
    private function getDbConfig() {
        return $this->dbConfig;
    }
    private function setDbConfig($dbConfig) {
        $this->dbConfig = $dbConfig;
    }
            
    public function getDB() { 
        if ( null != $this->db ) {
            return $this->db;
        }
        try {
            $config = $this->getDbConfig();
            $this->db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
        } catch (Exception $ex) {
          
           $this->closeDB();
        }
        return $this->db;        
    }
    
     public function closeDB() {        
        $this->db = null;        
    }
    
    
}