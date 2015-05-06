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
        
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );

        $pdo = new DB($dbConfig);
        $db = $pdo->getDB();
       
        $email = filter_input(INPUT_POST, 'email');
        $emailtype = filter_input(INPUT_POST, 'emailtype');
        $active = filter_input(INPUT_POST, 'active');
        $emailid = filter_input(INPUT_POST, 'emailid');
        
        $util = new Util();
        $validator = new Validator();
        $emailDAO = new EmailDAO($db);
        
        
        $emailModel = new EmailModel();
        $emailModel->setActive($active);
        $emailModel->setEmail($email);

        
        $emailService = new emailService($db, $util, $validator, $emailDAO, $emailModel);
        
        $emailService->saveForm();
        
        
        ?>
        
        
         <h3>Add email</h3>
        <form action="#" method="post">
            <label>Email:</label> 
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailtype; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
         
         <?php         
             $emailService->displayEmailsActions();
         ?>
         
         
    </body>
</html>
