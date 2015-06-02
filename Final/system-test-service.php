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
       
        $system = filter_input(INPUT_POST, 'system');
        $active = filter_input(INPUT_POST, 'active');
        $systemid = filter_input(INPUT_POST, 'systemid');
        
        $util = new Util();
        $validator = new Validator();
        $systemDAO = new SystemDAO($db);
        
        
        $systemModel = new SystemModel();
        $systemModel->setActive($active);
        $systemModel->setSystem($system);

        
        $systemService = new SystemService($db, $util, $validator, $systemDAO, $systemModel);
        
        $systemService->saveForm();
        
        
        ?>
        
        
        <h3>Add System</h3>
        <form action="#" method="post">
            <label>System:</label> 
            <input type="text" name="system" value="<?php echo $system; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
            <br /><br />
        </form>
         
         
         <?php         
             $systemService->displayGamesActions();
         ?>
        <br />
        <a href="game-test-service.php">View update/delete table for games</a>
        <br /><br />
        <a href="game-test.php">View time log for games</a>
         
        
        <br /><br />
        <a href="logout.php">Log out</a>
    </body>
</html>
