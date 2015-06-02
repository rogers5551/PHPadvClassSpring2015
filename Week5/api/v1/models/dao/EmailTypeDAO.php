<?php
/**
 * Description of EmailTypeDAO
 *
 * @author User
 */

namespace API\models\services;

use API\models\interfaces\IDAO;
use API\models\interfaces\IModel;
use API\models\interfaces\ILogging;
use \PDO;

class EmailTypeDAO extends BaseDAO implements IDAO {
    
    public function __construct( PDO $db, IModel $model, ILogging $log ) {        
        $this->setDB($db);
        $this->setModel($model);
        $this->setLog($log);
    }
          
    public function idExisit($id) {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
         
        if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         return false;
    }
    
    public function read($id) {
         
         $model = clone $this->getModel();
         
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT * FROM emailtype WHERE emailtypeid = :emailtypeid");
         
         if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->reset()->map($results);
         }
         
         return $model;
    }
    
    
    public function create(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":emailtype" => $model->getEmailtype(),
                          ":active" => $model->getActive()
                    );
                         
         if ( !$this->idExisit($model->getEmailtypeid()) ) {
             
             $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype, active = :active");
             
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             }
         }
                  
         
         return false;
    }
    
    
     public function update(IModel $model) {
                 
         $db = $this->getDB();
         
         $binds = array( ":emailtype" => $model->getEmailtype(),
                          ":active" => $model->getActive(),
                          ":emailtypeid" => $model->getEmailtypeid()
                    );
         
                
         if ( $this->idExisit($model->getEmailtypeid()) ) {
            
             $stmt = $db->prepare("UPDATE emailtype SET emailtype = :emailtype, active = :active WHERE emailtypeid = :emailtypeid");
         
             if ( $stmt->execute($binds) && $stmt->rowCount() > 0 ) {
                return true;
             } else {
                 $error = implode(",", $db->errorInfo());
                 $this->getLog()->logError($error);
             }
             
         } 
         
         return false;
    }
    
    public function delete($id) {
          
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM emailtype WHERE emailtypeid = :emailtypeid");

        if ( $stmt->execute(array(':emailtypeid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        } else {
            $error = implode(",", $db->errorInfo());
            $this->getLog()->logError($error);
        }
         
         return false;
    }
    
    public function getAllRows() {
       $db = $this->getDB();
       $values = array();
       
        $stmt = $db->prepare("SELECT * FROM emailtype");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $value) {
               $model = clone $this->getModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
        }
        
        $stmt->closeCursor();
         return $values;
    }
     
    
     
}
