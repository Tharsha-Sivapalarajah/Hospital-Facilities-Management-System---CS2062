<?php



    require_once('../../PHPMailer/credential.php');
    require_once("../../Result/Database.php");

    $db = Database::getdb();

    // Check whether all fields are duly filled or not.
    if (!empty($_POST['fac']) && !empty($_POST['start-time']) && !empty($_POST['end-time'])) {

        $HospitalID = $_GET['ID'];
        $HosName =$_GET['hname'];

        $FacilityName = $_POST['fac'];
        $StartTime = $_POST['start-time'];
        $EndTime = $_POST['end-time'];

        // Check whether the facility is new to the system or not.
        if ($db -> fetch_facilityID ($FacilityName) == NULL) {

            // Add the new facility to the system.
            $record = $db -> insert_facility ($FacilityName);

            if (!$record) {
                echo "alert('New Facility is not added to the system');";
            }
        }

        // Get the relevant facility ID from the database.
        $row = $db -> fetch_facilityID ($FacilityName);
        $FacilityID =  $row['FacilityID'];

        // Check whether the hospital facility is duplicated or not.
        $duplicate_times = $db -> duplicate_hfacility ($HospitalID, $FacilityID);

        // Check whether the hospital facility is already unavailable or not
        $removed_times = $db -> removed_hfacility ($HospitalID, $FacilityID);


        if($duplicate_times > 0) {
            header("Location: ../UpdateFac/update_hfac_confirm.php?hname= $HosName &hid= $HospitalID & fid=$FacilityID & stime=$StartTime & etime=$EndTime ");
        }
        elseif ($removed_times > 0) {

            // Make already removed hospital facility available.
            $db -> make_available_hfacility ($HospitalID, $FacilityID, $StartTime, $EndTime);

            echo "<script> alert('New Hospital Facility is added to the relevant Hospital.'); </script>";
            echo "<script> location.href = '../../../HTML/AdminPage/sub_admin_home.php'; </script>"; // Direct the page to sub admin home page
            
        }
        else {
            header("Location: ../AddFacility/add_hfacility_confirm.php?hname= $HosName &hid= $HospitalID & fid=$FacilityID & stime=$StartTime & etime=$EndTime ");
        }

    }
    else{
        echo "<script>alert('All fields required to be filled.');</script>";
        require_once("../facilities_page.php");
    }

?>