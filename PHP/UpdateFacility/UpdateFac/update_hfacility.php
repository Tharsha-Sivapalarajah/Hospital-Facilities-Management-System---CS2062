<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Existing Hospital Facility</title>
    <link rel="stylesheet" href="../../../CSS/del_hoss.css" >
</head>
<body>

<?php

    require_once('../../PHPMailer/Mail.php');
    require_once("../../Result/Database.php");

    $db = Database::getdb();

    
    $HospitalID = $_GET['hid'];
    $FacilityID = $_GET['fid'];
    $StartTime = $_GET['stime'];
    $EndTime = $_GET['etime'];


    // Get the relevant hospital Name from the database.
    $records = $db -> fetch_hospitalName ($HospitalID);
    $row = $records -> fetch_assoc();
    $HospitalName =  $row['Name'];

    // Get the relevant facility Name from the database.
    $records = $db -> fetch_facilityName ($FacilityID);
    $row = $records -> fetch_assoc();
    $FacilityName =  $row['FacilityName'];


    // Update the exisiting hospital facility details of the relevant hospital
    $db -> update_hfacility ($HospitalID, $FacilityID, $StartTime, $EndTime);
    
    // Update the time slot of emailing users of the relevant hospital facility.
    $db -> update_time ($StartTime, $EndTime, $HospitalName, $FacilityName);

    // Fetch mail users requested notification for the relevant hospital facility.
    $mailList = $db -> getUpdateMailUser($HospitalName, $FacilityName);

    // Email each requested user about the hospital facility changed time slot.
    foreach ($mailList as $mailDetail) {
        $email = $mailDetail[0];

        $subject = "Requested Hospital Facility Changed Time Slot Notification";
        $body = "{$FacilityName} in {$HospitalName} has changed its time slot due to certain incidents.
                The changed time slot is from " . getTimeFormat($StartTime) . " to " . getTimeFormat($EndTime) . " ";
    
        $mail = new Mail($email, $subject, $body);
        $mail -> send() ;
    }

    function getTimeFormat(string $time): string {
        $timeTempArray = explode(":", $time);
        $hour = (int)$timeTempArray[0];
        $min = (int)$timeTempArray[1];
        $format = "A.M";

        if($hour>12){
            $hour -= 12;
            $format = "P.M";
        }
        elseif($hour == 12 && $min>=0){
            $format = "P.M";
        }

        if($min < 10){
            $min = "0{$min}";
        }

        $output = "{$hour}:{$min} {$format}";

        return $output;
    }
?>

<script>
    alert('Relevant Hospital Facility Details are updated.');
    location.href = '../../../HTML/AdminPage/sub_admin_home.php'; // Direct the page to sub admin home page.
</script>


</body>
</html>