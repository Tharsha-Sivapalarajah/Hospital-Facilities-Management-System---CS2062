<?php
        
        require_once('../PHPMailer/credential.php');
        require_once("../Result/Database.php");

         $db = Database::getdb();
     
         $records = $db->fetch_vac();
         $locations = mysqli_fetch_all ($records, MYSQLI_ASSOC);
            echo json_encode($locations );
          

        

  ?>      
    
    
