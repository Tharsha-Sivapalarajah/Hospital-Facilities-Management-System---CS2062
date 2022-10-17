<?php
session_start();
if (!isset($_SESSION['logged-in'])){
    echo "<script>alert('Login to the System !!!');
    window.location.href='../../PHP/User_Login/login.php';</script>"
    ;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities</title>
    <link rel="stylesheet" href="../../CSS/facilities_page.css">
</head>
<body>

    <?php
        
        require_once('../PHPMailer/credential.php');
        require_once("../Result/Database.php");

        $db = Database::getdb();

        // Get the relevant Hospital ID from the database.
        $HospitalName = $_GET['hospital'];  
        


        echo( "<div class=\"Hospital-Name\">$HospitalName</div>
        <div class=\"container\"> ");         
        $HospitalID = $db -> fetch_hospitalID ($HospitalName);

        $records = $db -> fetch_facility ($HospitalID);
        while ($facility = $records -> fetch_assoc()) {
    
            $data = $db -> fetch_facilityName ($facility["FacilityID"]);

            // Display all the existing available facility details of the relevant hospital.
            while($facility_names = mysqli_fetch_row($data)){
                foreach ($facility_names as $facility_name){
                    
                    $div = '<div class="facility">
                                <div class="facility-box">
                                    <h3 class="facility-heading">' .$facility_name. '</h3>
                                    <div class="time-box">
                                        <div class="start-time">
                                            <h4>Start time</h4>
                                            <div class="time">' .$facility["sTime"]. '</div>
                                        </div>
    
                                        <div class="end-time">
                                            <h4>End time</h4>
                                            <div class="time">' .$facility["eTime"]. '</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="del">
                                    <a href = "DeleteFacility/del_hfac_confirm.php?hname='.$HospitalName.'&hid='.$HospitalID.' & fname= '.$facility_name.' ">
                                    <img class="close" src="../../CSS/del.jpeg" >
                                    </a>
                                </div>
                            </div> ';
                    echo $div;
                }
            }
        }
            
    ?>

    
    <!-- Add Facility block -->
    <div class="add-fac">
        +
    </div>
    </div>

    <!-- Form to add faclitiy -->
    <div class="model add-form-model">
        <div class="close-model"></div>
        <form action="AddFacility/add_facility.php?ID=<?php echo $HospitalID?>&hname=<?php echo $HospitalName?>" method="POST" class="add-form">
            
            <label for="fac">Facility</label>
            <input type="text" id="fac" name="fac" placeholder="Enter facility name.." required/>
           

            
            <label for="start-time">Start time</label>
            <input type="time" id="start-time" name="start-time"  required/>
            

            
            <label for="end-time">End time</label>
            <input type="time" id="end-time" name="end-time" required/>
            

            <button type="submit" name="add" class="submit add">Submit </button>
      
        </form>
    </div>

    <script src="../../JScript/facilities_page.js"></script>
</body>
</html>