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
        $systemDAO = new SystemDAO($db);
        $systemModel = new SystemModel();
         
        if ( $util->isPostRequest() ) {
            
            $systemModel->map(filter_input_array(INPUT_POST));
                       
        } else {
            $systemid = filter_input(INPUT_GET, 'systemid');
            $systemModel = $systemDAO->getById($systemid);
        }
        
        
        $systemid = $systemModel->getSystemid();
        $system = $systemModel->getSystem();
        $active = $systemModel->getActive();  
              
        
        $systemService = new SystemService($db, $util, $validator, $systemDAO, $systemModel);
        
        if ( $systemDAO->idExisit($systemModel->getSystemid()) ) {
            $systemService->saveForm();
        }
        
        
        ?>
        
        
         <h3>Update System</h3>
        <form action="#" method="post">
             <input type="hidden" name="systemid" value="<?php echo $systemid; ?>" />
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
        <br /><br /> 
        <a href="system-test-service.php">Add system</a>
        <br /><br />
        <a href="game-test-service.php">View update/delete table for games</a>
        <br /><br />
        <a href="game-test.php">View time log for games</a>
        <br /><br />
        <a href="logout.php">Log out</a>
    </body>
</html>
