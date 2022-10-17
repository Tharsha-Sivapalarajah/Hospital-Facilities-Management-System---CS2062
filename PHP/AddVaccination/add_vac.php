<?php
    require_once('../PHPMailer/credential.php');
    require_once("../Result/Database.php");

    $db = Database::getdb();

    //Check whether all fields are duly filled or not.
    if (!empty($_POST['name']) && !empty($_POST['lat']) && !empty($_POST['lon']) && !empty($_POST['for'])) {

        $VaccinationCenterName = $_POST['name'];
        $Latitude = $_POST['lat'];
        $Longitude = $_POST['lon'];
        $Information = $_POST['for'];

        // Check whether the vaccination center is duplicated or not.
        $duplicate_times = $db -> duplicate_vaccination_center ($VaccinationCenterName);

        // Check whether the vaccination center is already removed or not.
        $removed_times = $db -> removed_vaccination ($VaccinationCenterName);

        if($duplicate_times > 0) {
            require_once('../../HTML/AddVaccination/duplicate_vaccination_center.html');
        }
        elseif($removed_times > 0) {

            //Make already removed Vaccination Center available.
            $db -> make_available_vaccination ($VaccinationCenterName);
            
            echo "<script> alert('New Vaccination System is added to the system.'); </script>";
            echo " <script> location.href = '../../HTML/AdminPage/main_admin_home.php'; </script>" ;  // Direct the page to main admin home page.

        }
        else {
            header("Location: add_vac_confirm.php?name=$VaccinationCenterName & lat=$Latitude & lon=$Longitude & for=$Information");
        }
    }

    else{
        echo "<script> alert('All fields required to be filled.'); </script>";
        echo " <script> location.href = '../../HTML/AddVaccination/add_vac.php'; </script>" ; // Direct the page to add vaccination center page.
    }

 ?>