<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <?php
            
        
        if ( isset($scope->view['updated']) ) {
            if( $scope->view['updated'] ) {        
                 echo 'Email Updated';
            } else {
                 echo 'Email NOT Updated';
            }                 
        }
        
         $emailType = $scope->view['model']->getEmailtype();
         $active = $scope->view['model']->getActive();
         $emailtypeid = $scope->view['model']->getEmailtypeid();
        ?>
        
        
         <h3>Edit email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailtype" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="number" max="1" min="0" name="Active" value="<?php echo $active; ?>" />
            <input type="hidden"  name="emailtypeid" value="<?php echo $emailtypeid; ?>" />
            <input type="hidden" name="action" value="update" />
            <input type="submit" value="Submit" />
        </form>
         
         <br />
         <br />
         
        <form action="#" method="post">
            <input type="hidden" name="action" value="add" />
            <input type="submit" value="ADD Page" /> 
        </form>
         
         
         <?php
         
         if ( count($scope->view['EmailTypes']) <= 0 ) {
            echo '<p>No Data</p>';
        } else {
            
            
             echo '<table border="1" cellpadding="5"><tr><th>Email Type</th><th>Active</th><th></th><th></th></tr>';
             foreach ($scope->view['EmailTypes'] as $value) {
                echo '<tr>';
                echo '<td>', $value->getEmailtype(),'</td>';
                echo '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="emailtypeid" value="',$value->getEmailtypeid(),'" /><input type="hidden" name="action" value="edit" /><input type="submit" value="EDIT" /> </form></td>';
                echo '<td><form action="#" method="post"><input type="hidden"  name="emailtypeid" value="',$value->getEmailtypeid(),'" /><input type="hidden" name="action" value="delete" /><input type="submit" value="DELETE" /> </form></td>';
                echo '</tr>' ;
            }
            echo '</table>';
            
        }
         
         
         ?>
         
    </body>
</html>
