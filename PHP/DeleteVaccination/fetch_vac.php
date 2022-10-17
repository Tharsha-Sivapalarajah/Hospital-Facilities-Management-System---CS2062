<?php

session_start();
if (!isset($_SESSION['logged-in'])){
    echo "<script>alert('Login to the System !!!');
    window.location.href='../../PHP/User_Login/login.php';</script>"
    ;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Vaccination Center</title>
    <link rel="stylesheet" href="../../CSS/del_vac.css" >
</head>
<body>
    
    <div class="container">
        <input class="search" type="text" placeholder="Search vaccination center.." />
    <?php
        require_once('../PHPMailer/credential.php');
        require_once("../Result/Database.php");

        $db = Database::getdb();
        $records = $db -> fetch_vaccination ();

        // Function to display all the existing available Vaccination Centers in the database.
        function displayVaccinations(iterable $Iterable) {
            foreach ($Iterable as $item){
                $div = " <div class=\"vaccination\" onclick=\"window.location.href='del_vac_confirm.php?vaccination= ".$item." '\"> <img src=\"../../CSS/minus.png\"> <div class=\"vaccination-name\">
                         " .$item.
                       " </div> </div>";
                echo $div ;
            }
        }

        // Iterate over the structure.
        while ($vaccinations = mysqli_fetch_row($records)) {
            displayVaccinations($vaccinations);
        }
   
    ?>
    </div>
    
    <script src="../../JScript/del_vaccination_script.js"></script>
</body>
</html>