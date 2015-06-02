<?php

class GameService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_GameDAO;
    private $_GameModel;


    public function __construct($db, $util, $validator, $gamedao, $gameModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_GameDAO = $gamedao;
        $this->_GameModel = $gameModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_GameDAO->save($this->_GameModel) ) {
                echo 'Game Added/updated';
            } else {
                echo 'Game could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->gameIsValid($this->_GameModel->getGame()) ) {
                 $this->_errors[] = 'Game is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_GameModel->getActive()) ) {
                 $this->_errors[] = 'Active is invalid';
            } 
        }
         
    }
    
    
    public function displayErrors() {
       
        foreach ($this->_errors as $value) {
            echo '<p>',$value,'</p>';
        }
         
    }
    
    public function hasErrors() {        
        return ( count($this->_errors) > 0 );        
    }


    public function displayGames() {        
        $stmt = $this->_DB->prepare("SELECT * FROM game");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['game'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
    
    public function displayGamesActions() {        
       // Notice in the previous function I should have called get all rows
        
        $games = $this->_GameDAO->getAllRows();
        
        if ( count($games) < 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>Game</th><th>System</th><th>Active</th><th></th><th></th></tr>';
             foreach ($games as $value) {
                echo '<tr>';
                echo '<td>', $value->getGame(),'</td>';
                echo '<td>', $value->getSystem(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><a href=game-update.php?gameid=',$value->getGameid(),'>Update</a></td>';
                echo '<td><a href=game-delete.php?gameid=',$value->getGameid(),'>Delete</a></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
    }
    
    
    
    
}
