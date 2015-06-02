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
        
        
        $game = filter_input(INPUT_POST, 'game');
        $systemid = filter_input(INPUT_POST, 'systemid');
        $active = filter_input(INPUT_POST, 'active');
        
        
        $systemDAO = new SystemDAO($db);
        $gameDAO = new GameDAO($db);
         
        $systems = $systemDAO->getAllRows();
        
        $util = new Util();
         
        if ( $util->isPostRequest() ) {
                            
               $validator = new Validator(); 
                $errors = array();
                if( !$validator->gameIsValid($game) ) {
                    $errors[] = 'Game is invalid';
                } 
                
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }
                
                if ( empty($systemid) ) {
                     $errors[] = 'System is invalid';
                }
                
                
                
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                    }
                } else {
                    
                    
                    $gameModel = new GameModel();
                    
                    $gameModel->map(filter_input_array(INPUT_POST));
                    
                   // var_dump($systemModel);
                    if ( $gameDAO->save($gameModel) ) {
                        echo 'Game Added';
                    } else {
                        echo 'Game not added';
                    }
                    
                }
          }
        
        ?>
        
        
         <h3>Add Game</h3>
        <form action="#" method="post">
            <label>Game:</label>            
            <input type="text" name="game" value="<?php echo $game; ?>" placeholder="" />
            <br /><br />
            
            <label>System:</label>
            <select name="systemid">
            <?php 
                foreach ($systems as $value) {
                    if ( $value->getSystemid() == $systemid ) {
                        echo '<option value="',$value->getSystemid(),'" selected="selected">',$value->getSystem(),'</option>';  
                    } else {
                        echo '<option value="',$value->getSystemid(),'">',$value->getSystem(),'</option>';
                    }
                }
            ?>
            </select>
            <a href="system-test-service.php">Add System</a>
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <input type="submit" value="Submit" />
            <br /><br />
            <a href="game-test-service.php">View update/delete table</a>
        </form>
         
            <table border="1" cellpadding="5">
                <tr>
                    <th>Game</th>
                    <th>System</th>
                    <th>Last updated</th>
                    <th>Logged</th>
                    <th>Active</th>
                </tr>
         <?php 
            $games = $gameDAO->getAllRows(); 
            foreach ($games as $value) {
                echo '<tr><td>',$value->getGame(),'</td><td>',$value->getSystem(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td></tr>' ;
            }

         ?>
            </table>
         
         <br /><br />
        <a href="logout.php">Log out</a>
    </body>
</html>
