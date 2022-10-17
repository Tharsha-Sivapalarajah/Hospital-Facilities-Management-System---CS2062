<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Existing Hospital Facility</title>
    <link rel="stylesheet" href="../../../CSS/del_hoss.css" >
</head>
<body>

<?php

    require_once('../../PHPMailer/Mail.php');
    require_once("../../Result/Database.php");

    $db = Database::getdb();

    
    $HospitalID = $_GET['hid'];
    $FacilityName = $_GET['fname'];
    
 
    // Get the relevant facility ID from the database.
    $row = $db -> fetch_facilityID ($FacilityName);
    $FacilityID = $row['FacilityID'];

    // Get the relevant hospital Name from the database.
    $records = $db -> fetch_hospitalName ($HospitalID);
    $row = $records -> fetch_assoc();
    $HospitalName =  $row['Name'];


    // Make the relevant hospital facility unavailable.
    $db -> remove_facility ($HospitalID, $FacilityID);

    // Fetch mail users requested notification for the relevant hospital facility.
    $mailList = $db -> getUpdateMailUser($HospitalName, $FacilityName);

    // Email each requested user about the hospital facility unavailability.
    foreach ($mailList as $mailDetail) {
        $email = $mailDetail[0];
        $id = $mailDetail[1];

        var_dump("{$id}");
        $subject = "Requested Hospital Facility Unavailable Notification";
        $body = "{$FacilityName} in {$HospitalName} is unavailable due to some certain incidents. Sorry for the inconvenience caused. ";
    
        $mail = new Mail($email, $subject, $body);
        if($mail->send()){
            $db -> updateRow("{$id}");
        }
    }

?>

<script>
    alert('Relevant Facility is unavailable in the Hospital at the moment.');
    location.href = '../../../HTML/AdminPage/sub_admin_home.php'; // Direct the page to sub admin home page.
</script>


</body>
</html>