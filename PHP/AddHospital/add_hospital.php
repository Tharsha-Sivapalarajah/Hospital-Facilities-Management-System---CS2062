<?php

    require_once('../PHPMailer/credential.php');
    require_once("../Result/Database.php");

    $db = Database::getdb();

    $HospitalName = $_GET['hos'];
    $District = $_GET['dis'];
    $Information = $_GET['info'];
    $HClerkEmail = $_GET['email'];
    $HospitalImage = $_GET['img'];

    // Add new hospital to the database.
    $add_Record = $db -> insert_hospital ($HospitalName, $District, $Information, $HospitalImage);
    if($add_Record) {

        // Get hospital ID from the database.
        $HospitalID = $db -> fetch_hospitalID ($HospitalName);
        echo $HospitalID;

        // Add relevant hospital clerk details to the database.
        $add_Clerk = $db -> insert_clerk ($HospitalID, $HClerkEmail);
        
        if($add_Clerk) {

            echo "<script> alert('New Hospital is added to the system.'); </script>";
            echo "<script> location.href = '../../HTML/AdminPage/main_admin_home.php'; </script>"; // Direct the page to main admin home page.

        }
        else {
            $db -> remove_hospital ($HospitalName);
            echo "<script>alert('Hospital Clerk is not added to the system.');</script>";
        }
    }
    else {
        echo "<script>alert('New Hospital is not added to the system.');</script>";
    }
?>