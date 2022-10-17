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
    <title>Delete Hospital</title>
    <link rel="stylesheet" href="../../CSS/del_hoss.css" >
</head>
<body>
    
    <div class="container">
        <input class="search" type="text" placeholder="Search hospital.." />
    <?php

        require_once('../PHPMailer/credential.php');
        require_once("../Result/Database.php");


        $db = Database::getdb();
        $records = $db -> fetch_hospital ();

        // Function to display all the existing available hospitals in the database.
        function displayHospitals(iterable $Iterable) {
            foreach ($Iterable as $item){
                $div = " <div class=\"hospital\" onclick=\"window.location.href='del_hos_confirm.php?hospital= $item'\"> <img src=\"../../CSS/minus.png\"> <div class=\"hos-name\">"
                         .$item.
                        "</div> </div>";
                echo $div ;
            }
        }

        // Iterate over the structure.
        while ($hospitals = mysqli_fetch_row($records)) {
            displayHospitals($hospitals);
        }
   
    ?>
    </div>
    
    <script src="../../JScript/del_hos_script.js"></script>
</body>
</html>