<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Hospital Details</title>
    <link rel="stylesheet" href="../../CSS/del_hoss.css" >
</head>
<body>
    
    <div class="container">
        <input class="search" type="text" placeholder="Search hospital.." />
    <?php

        require_once('../PHPMailer/credential.php');
        require_once("../Result/Database.php");;

        $db = Database::getdb();

        $records = $db -> fetch_hospital ();

        // Function to display all the existing available hospitals in the database.
        function displayHospitals(iterable $Iterable) {
            foreach ($Iterable as $item){
                $div = " <div class=\"hospital\"> <img src=\"../../CSS/minus.png\"> <div class=\"hos-name\">
                         <a href='facilities_page.php?hospital= ".$item." '>" .$item.
                       " </a></div> </div>";
                echo $div ;
            }
        }

        // Iterate over the structure.
        while ($hospitals = mysqli_fetch_row($records)) {
            displayHospitals($hospitals);
        }
            
    ?>
    </div>

    <script src="../../JScript/update_hos_details_script.js"></script>
</body>
</html>