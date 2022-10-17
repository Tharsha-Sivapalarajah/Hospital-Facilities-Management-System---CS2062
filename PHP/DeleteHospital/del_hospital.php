<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Hospital</title>
    <link rel="stylesheet" href="../../CSS/del_hoss.css" >
</head>
<body>

<?php
    require_once('../PHPMailer/credential.php');
    require_once("../Result/Database.php");

    $db = Database::getdb();

    $HospitalName = $_GET['hospital'];

    // Get hospital ID from the database.
    $HospitalID = $db -> fetch_hospitalID ($HospitalName);

    // Make both hospital and relevant hospital clerk unavailable.
    $db -> remove_hospital ($HospitalName);
    $db -> remove_clerk ($HospitalID);


?>

<script>
    alert('Relevant Hospital is removed from the system.');
    location.href = '../../HTML/AdminPage/main_admin_home.php'; // Direct the page to main admin home page.
</script>

</body>
</html>