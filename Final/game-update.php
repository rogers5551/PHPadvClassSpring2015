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
       
        $util = new Util();
        $validator = new Validator();
        $gameDAO = new GameDAO($db);
        $gameModel = new GameModel();
        
        $systemDAO = new systemDAO($db);
        $systems = $systemDAO->getAllRows();
         
        if ( $util->isPostRequest() ) {
            
            $gameModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $gameid = filter_input(INPUT_GET, 'gameid');
            $gameModel = $gameDAO->getById($gameid);
        }
        
        
        $gameid = $gameModel->getGameid();
        $game = $gameModel->getGame();
        //$system = $gameModel->getSystem();
        $active = $gameModel->getActive();  
              
        
        $gameService = new GameService($db, $util, $validator, $gameDAO, $gameModel);
        
        if ( $gameDAO->idExisit($gameModel->getGameid()) ) {
            $gameService->saveForm();
        }
        
        
        ?>
        
        
         <h3>Update Game</h3>
        <form action="#" method="post">
             <input type="hidden" name="gameid" value="<?php echo $gameid; ?>" />
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
            </select><a href="system-test-service.php">Add System</a>
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
            <br /><br />
        </form>
         
         
         <?php         
             $gameService->displayGamesActions();
                          
         ?>
        
         <br /><br />
         <a href="game-test-service.php">Add Game</a>
         <br /><br />
        <a href="logout.php">Log out</a>
    </body>
</html>
