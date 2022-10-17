<?php 
session_start();
unset($_SESSION['logged-in']);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../CSS/style.css">
</head>
<body>
    
<?php

require_once 'FacilityField.php';
require_once 'DistrictField.php';
require_once 'HospitalField.php';
require_once 'Detail.php';

$detail = new Detail();
$facilityField = new FacilityField($detail);
$districtField = new DistrictField($detail);
$hospitalField = new HospitalField($detail);

$body = "
<div class=\"search-box\">
<div class=\"view-vac-button\" >💉 View Vaccination Centre</div>
<div class=\"login-button\" onclick=\"window.location.href='../User_Login/login.php'\">login</div>
    <div class=\"selectbox-container\">" . $districtField->getHtml() . $facilityField->getHtml() . $hospitalField->getHtml() . "</div><button type=\"submit\" class=\"submit-button\">Search</button>
</div>";


echo $body;

?>
<script type="module" src="../../JScript/script.js"></script>
<script src="../../JScript/jquery-3.6.0.min.js"></script>
</body>
</html>