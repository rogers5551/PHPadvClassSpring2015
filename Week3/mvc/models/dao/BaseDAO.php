<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseDAO
 *
 * @author User
 */

namespace App\models\services;
use \App\models\interfaces\IModel;
use App\models\interfaces\ILogging;
use \PDO;

abstract class BaseDAO {
    
    protected $DB = null;
    protected $model;
    protected $log = null;


    protected function setDB(PDO $DB) {        
        $this->DB = $DB;
    }
    
    protected function getDB() {
        return $this->DB;
    }
    
    protected function getModel() {
        return $this->model;
    }

    protected function setModel(IModel $model) {
        $this->model = $model;
    }
    
    protected function getLog() {
        return $this->log;
    }

    protected function setLog(ILogging $log) {
        if ( $log instanceof ILogging) {
            $this->log = $log;
        }
        
    }
    /*
    public function getAllRows($limit = "", $offset = "", $table = "") {
       
         $values = array();
         if ( empty($table) ) {         
             return $values;
         }
        $db = $this->getDB();
        $binds = array();
        $sql = "";
        
        if ( !empty($limit) && is_numeric($limit) && intval($limit) > 0 ) {
            $sql .= 'LIMIT';
            if ( is_numeric($offset) ) {   
                $sql .= ' :offset,'; 
                $binds[":offset"] = intval($offset);
            }        
            $sql .= ' :limit'; 
            $binds[":limit"] = intval($limit);                        
        }
        
        
        $stmt = $db->prepare("SELECT * FROM $table $sql");
        
        if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = clone $this->getModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
             
        }   else {
            
           //log($db->errorInfo() .$stmt->queryString ) ;
           
        }  
        
        $stmt->closeCursor();
         
         return $values;
     }
     
     
     
     public function find($column = "", $search = "", $table = "") {

        $values = array();
        if ( empty($table) || empty($column) || empty($search) ) {         
             return $values;
         }
        $db = $this->getDB();

        $stmt = $db->prepare("SELECT * FROM $table WHERE $column LIKE :search");
        
        $search = '%'.$search.'%';

        if ($stmt->execute(array(':search' => $search)) && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = clone $this->getModel();
               $model->reset()->map($value);
                $values[] = $model;
            }
        } else {
            
           //log($db->errorInfo() .$stmt->queryString ) ;
           
        }  

        return $values;
    }
*/

}
