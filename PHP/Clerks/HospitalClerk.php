<?php
//session_start();
//require 'hospitalObject.php';
require 'Clerk.php';

class HospitalClerk extends Clerk{
    public  function get_Page(){
        $id  = $this->get_ID();
        require_once '../PHPMailer/credential.php';
        require_once '../Result/Database.php';
        $dataB = Database::getdb();
        //$hoss = $hospital['HospitalName'];
        /*$Record = new mysqli(HOST, USER, DB_PASS, DB);
        $saved_data = "SELECT * FROM hospitals WHERE HospitalID = $id AND Availability = 1 ";
        $result = mysqli_query($Record, $saved_data)
        or die("connection Failed ");

        //data
        $hospital = mysqli_fetch_array($result);
        $hoss = $hospital['HospitalName'];*/
        //echo "<script>alert('hospital not created!!!');</script>";
        //$hospital_object = new Hospital_Object($hospital['HospitalName'],$hospital['HospitalID'],$hospital['Distric']);
        //echo "<script>alert('Hi . $hoss .!!!');</script>";
        session_start();
        $_SESSION["hoss"] = $dataB->get_hospital($id);
        header("location:../../HTML/AdminPage/sub_admin_home.php");

                
        
    }
}




?>