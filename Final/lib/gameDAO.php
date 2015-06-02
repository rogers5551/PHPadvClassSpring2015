<?php


class gameDAO implements IDAO
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
        $stmt = $db->prepare("SELECT gameid FROM game WHERE gameid = :gameid");
         
        if ( $stmt->execute(array(':gameid' => $id)) && $stmt->rowCount() > 0 )
        {
            return true;
        }
        return false;
    }
    
    public function getById($id) 
    {
         $model = new gameModel(); // this creates a dependacy, how can we fix this
         $db = $this->getDB();
         
         $stmt = $db->prepare("SELECT game.gameid, game.game, game.systemid, system.system, system.active as systemactive, game.logged, game.lastupdated, game.active"
                 . " FROM game LEFT JOIN system on game.systemid = system.systemid WHERE gameid = :gameid");
         
         if ( $stmt->execute(array(':gameid' => $id)) && $stmt->rowCount() > 0 ) {
             $results = $stmt->fetch(PDO::FETCH_ASSOC);
             $model->map($results);
         }
         
         return $model;
    }
    
    public function delete($id) 
    {
        $db = $this->getDB();         
        $stmt = $db->prepare("Delete FROM game WHERE gameid = :gameid");
         
        if ( $stmt->execute(array(':gameid' => $id)) && $stmt->rowCount() > 0 ) {
            return true;
        }
         
        return false;
    }

    public function getAllRows() 
    {
        $values = array();         
        $db = $this->getDB();               
        $stmt = $db->prepare("SELECT game.gameid, game.game, game.systemid, system.system, system.active as systemactive, game.logged, game.lastupdated, game.active"
                 . " FROM game LEFT JOIN system on game.systemid = system.systemid");
        
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value) {
               $model = new gameModel();
               $model->reset()->map($value);
               $values[] = $model;
            }
             
        }   else {            
           //log($db->errorInfo() .$stmt->queryString ) ;           
        }  
        
        $stmt->closeCursor();         
        return $values;
    }

    public function save(IModel $model)
    {
        $db = $this->getDB();
         
        $values = array(":game" => $model->getGame(),
                        ":systemid" => $model->getSystemid(),
                        ":active" => $model->getActive(),     
        );

        if ( $this->idExisit($model->getGameid()) ) {
            $values[":gameid"] = $model->getGameid();
            $stmt = $db->prepare("UPDATE game SET game = :game, systemid = :systemid, logged = now(), lastupdated = now(), active = :active WHERE gameid = :gameid");
        } else {             
            $stmt = $db->prepare("INSERT INTO game SET game = :game, systemid = :systemid, logged = now(), lastupdated = now(), active = :active");
        }
          
        if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            return true;
        }
         
        return false;   
    }

}
