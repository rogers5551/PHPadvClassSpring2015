<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Email Type</title>
    </head>
    <body>
        
        
        <?php
       
        /* Start by creating the classes and files you need
         * 
         */
$util = new Util();
$validator = new Validator();
$emailTypeDB = new emailTypeDB();
/*
 * When dealing with forms always collect the data before trying to validate
 * 
 * When getting values from $_POST or $_GET use filter_input
 */
$emailType = filter_input(INPUT_POST, 'emailtype');
// We use errors to add issues to notify the user
$errors = array();
/*
 * We setup this config to get a standard database setup for the page
 */
$dbConfig = array(
        "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=phpadvclassspring2015',
        "DB_USER"=>'root',
        "DB_PASSWORD"=>''
        );
$pdo = new DB($dbConfig);

$db = $pdo->getDB();
/*
 * we utilize our classes to have less code on the page
 * 
 */
if ( $util->isPostRequest() ) {
    // we validate only if a post has been made
    if ( !$validator->emailTypeIsValid($emailType) ) {
        $errors[] = 'Email type is not valid';
    }
    
    
    
    
    // if there are errors display them
    if ( count($errors) > 0 ) {
        foreach ($errors as $value) {
            echo '<p>',$value,'</p>';
        }
    } else {
        //if no errors, save to to database.
        $emailTypeDB->saveEmailTypeDB($db, $emailType);   
    }
    
    
}
    
        
        
       
        ?>
        
         <h3>Add email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
         
         
    <?php 
        $emailTypeDB->displayEmailTypes($db);
    ?>
         
         
         
    </body>
</html>