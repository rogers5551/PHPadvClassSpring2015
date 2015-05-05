<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class emailTypeDB
{
    public function saveEmailTypeDB($db, $emailType)
    {
        $stmt = $db->prepare("INSERT INTO emailtype SET emailtype = :emailtype");  
        $values = array(":emailtype"=>$emailType);
        if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            echo 'Email type added';
        }
    }
    
    public function displayEmailTypes($db)
    {
        $stmt = $db->prepare("SELECT * FROM emailtype where active = 1");
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($results as $value) {
                echo '<p>', $value['emailtype'], '</p>';
            }
        } 
        else {
            echo '<p>No Data</p>';
        }
    }
}
