<?php

    require_once('../PHPMailer/credential.php');
    require_once("../Result/Database.php");

    $db = Database::getdb();

    $VaccinationCenterName = $_GET['name'];
    $Latitude = $_GET['lat'];
    $Longitude = $_GET['lon'];
    $Information = $_GET['for'];

    // Add new vaccination center to the system.
    $add_Record = $db -> insert_vaccination_center ($VaccinationCenterName, $Latitude, $Longitude, $Information);
    if($add_Record) {
        
        echo "<script> alert('New Vaccination System is added to the system.'); </script>";
        echo " <script> location.href = '../../HTML/AdminPage/main_admin_home.php'; </script>" ;  // Direct the page to main admin home page.

    }
    else {
        echo "<script>alert('New Vaccination Center is not added to the system.');</script>";
    }

?>