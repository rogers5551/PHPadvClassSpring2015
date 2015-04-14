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
}
