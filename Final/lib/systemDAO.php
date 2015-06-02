<?php


class systemDAO implements IDAO
{
    private $DB = null;
    
    public function __construct( PDO $db )
    {        
        $this->setDB($db);    
    }
    
    private function setDB( PDO $DB)
    {        
        $this->DB = $DB;
    }
    
    private function getDB()
    {
        return $this->DB;
    }
    
    public function idExisit($id)
    {
        
        $db = $this->getDB();
        $stmt = $db->prepare("SELECT systemid FROM system WHERE systemid = :systemid");
         
        if ( $stmt->execute(array(':systemid' => $id)) && $stmt->rowCount() > 0 )
        {
            return true;
        }
        return false;
    }
    
    public function getById($id) 
    {
         $model = new systemModel();
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT systemid, system, active FROM system WHERE systemid = :systemid");
         
         if ( $stmt->execute(array(':systemid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
         }
         
         return $model;
    }
    
    public function delete($id) 
    {
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM system WHERE systemid = :systemid");
         
        if ( $stmt->execute(array(':systemid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         
        return false;
    }

    public function getAllRows() 
    {
        $values = array();         
        $db = $this->getDB();               
        $stmt = $db->prepare("SELECT systemid, system, active FROM system");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value) {
               $model = new systemModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
             
        }   else {                      
        }  
        
        $stmt->closeCursor();         
        return $values;
    }

    public function save(IModel $model)
    {
        $db = $this->getDB();
         
        $values = array(":system" => $model->getSystem(),
                        ":active" => $model->getActive(),     
        );
         
                
        if ( $this->idExisit($model->getSystemid()) ) {
            $values[":systemid"] = $model->getSystemid();
            $stmt = $db->prepare("UPDATE system SET system = :system,  active = :active WHERE systemid = :systemid");
        } else {             
            $stmt = $db->prepare("INSERT INTO system SET system = :system,  active = :active");
        }
         
          
        if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            return true;
        }
         
        return false;   
    }

}
