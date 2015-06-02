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
        
            if(!isset($_SESSION['loggedin']))
            {
                header("Location: login.php");
            }
            
             $dbConfig = array(
                    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
                    "DB_USER"=>'root',
                    "DB_PASSWORD"=>''
                );

            $pdo = new DB($dbConfig);
            $db = $pdo->getDB();
                              
            // get values from URL
            $gameid = filter_input(INPUT_GET, 'gameid');
            
            if ( NULL !== $gameid ) {
               $gameDAO = new gameDAO($db);
               
               if ( $gameDAO->delete($gameid) ) {
                   echo 'Game was deleted';                  
               }                
        
            }
            
            
             echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';
        
        ?>
    </body>
</html>
