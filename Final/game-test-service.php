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
        //Checks if session variable is set... if it is not its kicks you out
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
        //initialize variables and filter their input
        $game = filter_input(INPUT_POST, 'game');
        $system = filter_input(INPUT_POST, 'system');
        $active = filter_input(INPUT_POST, 'active');
        $gameid = filter_input(INPUT_POST, 'gameid');
        $systemid = filter_input(INPUT_POST, 'systemid');
        //initializes helpers
        $util = new Util();
        $validator = new Validator();
        //initiializes DAOs
        $gameDAO = new GameDAO($db);
        $systemDAO = new SystemDAO($db);
        //Sends appropriate data to model
        $gameModel = new GameModel();
        $gameModel->setActive($active);
        $gameModel->setGame($game);
        $gameModel->setSystemid($systemid);
        $systems = $systemDAO->getAllRows();

        
        $gameService = new gameService($db, $util, $validator, $gameDAO, $gameModel);
        //Saves the form
        $gameService->saveForm();
        
        
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
            </select><a href="system-test-service.php">Add System</a>
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
            <br /><br />
            <a href="game-test.php">View time log for games</a>
        </form>
         
         
         <?php         
             $gameService->displayGamesActions();
         ?>
         
        <br /><br />
        <a href="logout.php">Log out</a>
         
    </body>
</html>
