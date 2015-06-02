<?php

class SystemService {
   
    private $_errors = array();
    private $_Util;
    private $_DB;
    private $_Validator;
    private $_SystemDAO;
    private $_SystemModel;


    public function __construct($db, $util, $validator, $systemDAO, $systemModel) {
        $this->_DB = $db;    
        $this->_Util = $util;
        $this->_Validator = $validator;
        $this->_SystemDAO = $systemDAO;
        $this->_SystemModel = $systemModel;
    }


    public function saveForm() {        
        if ( !$this->_Util->isPostRequest() ) {
            return false;
        }
        
        $this->validateForm();
        
        if ( $this->hasErrors() ) {
            $this->displayErrors();
        } else {
            
            if (  $this->_SystemDAO->save($this->_SystemModel) ) {
                echo 'Game Added/updated';
            } else {
                echo 'Game could not be added Added';
            }
           
        }
        
    }
    public function validateForm() {
       
        if ( $this->_Util->isPostRequest() ) {                
            $this->_errors = array();
            if( !$this->_Validator->systemIsValid($this->_SystemModel->getSystem()) ) {
                 $this->_errors[] = 'System is invalid';
            } 
            if( !$this->_Validator->activeIsValid($this->_SystemModel->getActive()) ) {
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
       // this doesn't make good use of the getallrows function in my DAO
        $stmt = $this->_DB->prepare("SELECT * FROM system");

        if ($stmt->execute() && $stmt->rowCount() > 0) {
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            foreach ($results as $value) {
                echo '<p>', $value['system'], '</p>';
            }
        } else {
            echo '<p>No Data</p>';
        }
        
    }
    
    public function displayGamesActions() {        
        
        $systems = $this->_SystemDAO->getAllRows();
        
        if ( count($systems) < 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>System</th><th>Active</th><th></th><th></th></tr>';
             foreach ($systems as $value) {
                echo '<tr>';
                echo '<td>', $value->getSystem(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><a href=system-update.php?systemid=',$value->getSystemid(),'>Update</a></td>';
                echo '<td><a href=system-delete.php?systemid=',$value->getSystemid(),'>Delete</a></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }   
    }
}
