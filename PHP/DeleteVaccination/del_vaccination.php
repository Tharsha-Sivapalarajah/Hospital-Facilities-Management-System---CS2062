<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Existing Vaccination Center</title>
    <link rel="stylesheet" href="../../CSS/del_vac.css" >
</head>
<body>

<?php
    require_once('../PHPMailer/credential.php');
    require_once("../Result/Database.php");

    $db = Database::getdb();

    $VaccinationCenterName = $_GET['vaccination'];

    // Make relevant Vaccination Center unavailable.
    $db -> remove_vaccination ($VaccinationCenterName);

?>

<script>
    alert('Relevant Vaccination Center is removed from the system.');
    location.href = '../../HTML/AdminPage/main_admin_home.php'; // Direct the page to main admin home page.
</script>

</body>
</html>