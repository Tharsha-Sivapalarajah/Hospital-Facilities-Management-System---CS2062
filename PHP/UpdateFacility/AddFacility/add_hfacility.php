<?php
    
    require_once('../../PHPMailer/credential.php');
    require_once("../../Result/Database.php");

    $db = Database::getdb();

    $HospitalID = $_GET['hid'];
    $FacilityID = $_GET['fid'];
    $StartTime = $_GET['stime'];
    $EndTime = $_GET['etime'];

    // Add new facility to the relevant hospital.
    $add_Facility = $db -> insert_hfacility ($HospitalID, $FacilityID, $StartTime, $EndTime);

    if($add_Facility) {

        echo "<script>alert('New Facility is added to the relevant Hospital.');</script>";
        echo "<script> location.href = '../../../HTML/AdminPage/sub_admin_home.php'; </script>"; // Direct the page to sub admin home page.
    }
    else {

        echo "<script>alert('New Facility is not added to the Hospital.');</script>";
    }

?>