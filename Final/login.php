<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         $util = new Util();
            
            if ( $util->isPostRequest() ) {
                $db = new DB($dbConfig); 
                $model = new signupModel();
                $signupDao = new signupDAO($db->getDB(), $model);            
                $model->map(filter_input_array(INPUT_POST));
                                
                if ( $signupDao->login($model) ) {
                    echo '<p>Login Sucess</p>';
                    $util->setLoggedin(true);
                    $util->redirect('game-test-service.php');
                } else {
                    echo '<p>Login Failed</p>';
                }
            }
        ?>
        
         <h1>Log in</h1>
        <form action="#" method="POST">
            
            Email : <input type="email" name="email" value="" /> <br /><br />
            Password : <input type="password" name="password" value="" /> <br />
            <br />
            <input type="submit" value="Log in" />
            <br /><br /><br />
            Don't have an account? <a href='signup.php'>Sign up!</a>
        </form>
    </body>
</html>