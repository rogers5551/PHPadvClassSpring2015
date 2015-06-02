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
                                
                if ( $signupDao->create($model) ) {
                    echo '<p>Signup complete</p>';
                } else {
                    echo '<p>Signup Failed</p>';
                }
            }
           
            
        ?>
        
        <h1>Sign up</h1>
        <form action="#" method="POST">
            
            Email : <input type="email" name="email" value="" /> <br /><br />
            Password : <input type="password" name="password" value="" /> <br /> 
            <br />
            <input type="submit" value="Sign up" />
            <br /><br /><br />
            <a href='login.php'>Log in</a>
        </form>
        
        
    </body>
</html>