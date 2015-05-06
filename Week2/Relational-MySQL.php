<?php 

include './bootstrap.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
        /*
         * Normally with relational MySQL your dealing with multipule databases that have a connection with another table.
         * 
         * In this example we have a email table that has a emailtypeid that is linked to the email type table.
         * We can use the emailtypeid from the email table to get a match from the emailtype table and get the emailtype.
         * 
         * email->emailtypeid belongs to emailtype->emailtypeid
         * 
         * 
         * if you need a review about joins this article is good
         * 
         * http://www.sitepoint.com/understanding-sql-joins-mysql-database/
         * 
         */
        

        $dbConfig = array(
                "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                "DB_USER"=>'root',
                "DB_PASSWORD"=>''
                );

        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
        
        $stmt = $db->prepare("SELECT emailid from email where email = :email");  
        $values = array(":email"=>'555-444-3333');
        
        if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            echo '<p>Email Already added</p>';
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
             
            // lets update the email
            $stmt = $db->prepare("UPDATE email SET lastupdated = now() where emailid = :emailid");  
            $values = array(":emailid"=>$result['emailid']);
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
                echo '<p>Email Updated</p>';
            }
            
            
        } else {
        
            // lets add a email
            // now() = MySql timestamp function
            $stmt = $db->prepare("INSERT INTO email SET email = :email, emailtypeid = :emailtypeid, logged = now(), lastupdated = now()");  
            $values = array(":email"=>'555-444-3333',":emailtypeid"=>'2');
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
                echo '<p>Email Added</p>';
            } 

        }
        
        
        
        
        /*
         * Selects see the data
         */
        $stmt = $db->prepare("SELECT email.email, emailtype.emailtype, email.logged, email.lastupdated FROM email LEFT JOIN emailtype on email.emailtypeid = emailtype.emailtypeid");  
                
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
        
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            echo '<table>';
            foreach ($results as $value) {
                echo '<tr>';
                echo '<td>', $value['email'], '</td>';
                echo '<td>', $value['emailtype'], '</td>';
                // we use the MySQL timestamp to format it in PHP
                echo '<td>', date("F j, Y g:i(s) a", strtotime($value['logged']))  , '</td>';
                echo '<td>', date("F j, Y g:i(s) a", strtotime($value['lastupdated'])) , '</td>';
                echo '</td>';
            }
             echo '</table>';
        } else {
            echo '<p>No Data</p>';
        }
        
        
        
        ?>
    </body>
</html>
