<?php

session_start();
if (!isset($_SESSION['logged-in'])){
    echo "<script>alert('Login to the System !!!');
    window.location.href='../../PHP/User_Login/login.php';</script>"
    ;
}
    require_once('../PHPMailer/credential.php');
    require_once("../Result/Database.php");

    $db = Database::getdb();

    //Check whether all the fields are duly filled or not.
    if (!empty($_POST['name']) && !empty($_POST['dis']) && !empty($_POST['for']) && !empty($_POST['email']) && !empty($_POST['img'])) {

        $HospitalName = $_POST['name'];
        $District = $_POST['dis'];
        $Information = $_POST['for'];
        $HClerkEmail = $_POST['email'];
        $HospitalImage = $_POST['img'];

        // Check whether the hospital is duplicated or not.
        $duplicate_times_hospital = $db -> duplicate_hospital ($HospitalName);

        // Check whether the hospital clerk detail is duplicated or not.
        $duplicate_times_clerk = $db -> duplicate_clerk ($HClerkEmail);

        // Check whether the hospital is already removed or not.
        $removed_times = $db -> removed_hospital ($HospitalName);
        
        if($duplicate_times_hospital > 0) {
            require_once('../../HTML/AddHospital/duplicate_hospital.html');
        }
        elseif ($duplicate_times_clerk > 0) {
            require_once('../../HTML/AddHospital/duplicate_clerk.html');
        } 
        elseif($removed_times > 0) {

            // Get hospital ID from the database.
            $HospitalID = $db -> fetch_hospitalID ($HospitalName);

            // Make already removed hospital available.
            $db -> make_available_hospital ($HospitalName, $District, $Information, $HospitalImage);

            //Check whether corresponding hospital clerk details are available or not.
            $check_ID = $db -> check_hospitalID ($HospitalID);

            if ($check_ID > 0) {
                $db -> make_available_clerk ($HospitalID, $HClerkEmail);
            }
            else {
                $record = $db -> insert_clerk ($HospitalID, $HClerkEmail);
            }
            
            echo "<script> alert('New Hospital is added to the system.'); </script>";
            echo "<script> location.href = '../../HTML/AdminPage/main_admin_home.php'; </script>"; // Direct the page to main admin home page.

        }
        else {
            header("Location: add_hos_confirm.php?hos=$HospitalName & dis=$District & info=$Information & email=$HClerkEmail & img=$HospitalImage");
        } 
    }

    else{  
        echo "<script> alert('All fields required to be filled.'); </script>";
        echo "<script> location.href = '../../HTML/AddHospital/add_hos.php'; </script>"; // Direct the page to add hospitals page.

    }

?>