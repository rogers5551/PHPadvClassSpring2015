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
        
        $stmt = $db->prepare("SELECT gameid from game where game = :game");  
        $values = array(":game"=>'555-444-3333');
        
        if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
            echo '<p>Game Already added</p>';
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $db->prepare("UPDATE game SET lastupdated = now() where gameid = :gameid");  
            $values = array(":gameid"=>$result['gameid']);
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
                echo '<p>Game Updated</p>';
            }
            
            
        } else {
        
            $stmt = $db->prepare("INSERT INTO game SET game = :game, systemid = :systemid, logged = now(), lastupdated = now()");  
            $values = array(":game"=>'555-444-3333',":systemid"=>'2');
            if ( $stmt->execute($values) && $stmt->rowCount() > 0 ) {
                echo '<p>Game Added</p>';
            } 

        }
        
        $stmt = $db->prepare("SELECT game.game, system.system, game.logged, game.lastupdated FROM game LEFT JOIN system on game.systemid = system.systemid");  
                
        if ( $stmt->execute() && $stmt->rowCount() > 0 ) {
        
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
           
            echo '<table>';
            foreach ($results as $value) {
                echo '<tr>';
                echo '<td>', $value['game'], '</td>';
                echo '<td>', $value['system'], '</td>';
                echo '<td>', date("F j, Y g:i(s) a", strtotime($value['logged']))  , '</td>';
                echo '<td>', date("F j, Y g:i(s) a", strtotime($value['lastupdated'])) , '</td>';
                echo '</td>';
            }
             echo '</table>';
        } else {
            echo '<p>No Data</p>';
        }
        
        
        
        ?>
    </body>
</html>
