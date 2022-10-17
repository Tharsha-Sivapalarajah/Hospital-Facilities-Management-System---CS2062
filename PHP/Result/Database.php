<?php
require_once 'Hospital.php';

class Database
{
    private static Database $dataB;
    private mysqli $db;
    private string $host;
    private string $user;
    private string $password;
    private string $database;

    private final function __construct(string $host, string $user, string $password, string $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->database = $database;
        $this->password = $password; 
        $this->db = new mysqli($host, $user, $password, $database);
        if(mysqli_connect_errno()) {
            echo "<h1>ERROR Conncetion</h1>";
            exit;
        }
    }

    public static function getdb() {
        if(!isset(self::$dataB)){
            self::$dataB = new Database(HOST, USER, DB_PASS, DB);
        }

        return self::$dataB;
    }


    public function setUser($newUsername, $password)
    {
        $this->user = $newUsername;
        $this->password = $password;
        $this->db->change_user($this->user, $this->password, $this->database);
        if(mysqli_connect_errno()) {
            echo "<h1>ERROR</h2>";
            exit;
        }
    }

    // have to add availability of hospital and facilities.
    public function getSearchableDetails():array
    {
        $list = array();
        $query = "SELECT Hospitals.Address, Hospitals.Name, Facilities.FacilityName FROM Facilities, Hospitals, FacilityManager WHERE Hospitals.HospitalID = FacilityManager.HospitalID AND Facilities.FacilityID = FacilityManager.FacilityID AND FacilityManager.sTime IS NOT NULL AND FacilityManager.eTime IS NOT NULL ORDER BY Hospitals.Address";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($districtName, $hospitalName, $facilityName);
        while($stmt->fetch()){
            $list[] = [$districtName, $hospitalName, $facilityName];
        }

        return $list;
    }

    // have to add availability of facilities.
    public function getHospital(string $hos):Hospital
    {
        $hospital = new Hospital($hos);
        $query = "SELECT Name, FacilityName, sTime, eTime FROM Facilities, FacilityManager, Hospitals WHERE Hospitals.Name=? AND Hospitals.HospitalID=FacilityManager.HospitalID AND Facilities.FacilityID=FacilityManager.FacilityID AND sTime IS NOT NULL AND eTime IS NOT NULL";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $hos);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($name, $facilityName, $sTime, $eTime);
        while($stmt->fetch()){
            if($name != $hos) continue;
            $hospital->setFacility($facilityName, $sTime, $eTime);
        }

        return $hospital;
    }

    public function saveUsermail(string $email, string $facName, string $hosName, string $sTime, string $eTime){
        $query = "INSERT INTO Users (Email, FacilityName, HospitalName, sTime, eTime) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss', $emaili, $facNamei, $hosNamei, $sTimei, $eTimei);
        $emaili = $email;
        $facNamei = $facName;
        $hosNamei = $hosName;
        $sTimei = $sTime;
        $eTimei = $eTime; 
        
        $stmt->execute();
        $stmt->close();
        $this->db->close();
    }

    public function getMailUser():array
    {
        $query = "SELECT Users.Email, Users.HospitalName, Users.FacilityName, Users.sTime,
        Users.eTime, Users.UserID FROM Users WHERE Users.Message=1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($email, $hospital, $facility, $sTime, $eTime, $id);
        
        $output = array();
        while($stmt->fetch()){
            if(abs(strtotime("now") - strtotime($sTime)) <= 300){
                array_push($output, array($email, $hospital, $facility, $sTime, $eTime, $id));
            }

        }

        while($this->db->more_results()){
            $this->db->next_result();
            $this->db->use_result();
        }

        return $output;

    }

    public function updateRow(string $primaryKey)
    {
        echo "Starting<br>";
        $query = "UPDATE Users SET Message = 0 WHERE UserID = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $primaryKeyi);

        $primaryKeyi = $primaryKey;

        $stmt->execute();
        $stmt->close();
    }

    // have to add availability of vaccination centers.
    //function to fetch Vaccination centre details
    public function fetch_vac(){
        $records= mysqli_query($this->db,"SELECT Name,Lat,Lon,Info FROM VaccinationCenters WHERE Availability = 1");
        return $records;
    }


    

    // Function to add new hospital to the system.
    public function insert_hospital ( $HospitalName, $District, $Information, $HospitalImage) { 
        $record = mysqli_query($this->db, " INSERT into Hospitals(Name, Address, Information, HospitalImage)
        values('$HospitalName', '$District', '$Information', '$HospitalImage')");
        return $record;

    }

     // Function to add relevant hospital clerk to the system.
    public function insert_clerk ($HospitalID, $HClerkEmail) { 
        $record = mysqli_query($this->db, " INSERT into clerks(HospitalID, HClerkEmail)
        values('$HospitalID', '$HClerkEmail')");
        return $record;
    }

    // Function to add new vaccination center to the system.
    public function insert_vaccination_center ($VaccinationCenterName, $Latitude, $Longitude, $Information) { 
        $record = mysqli_query($this->db, " INSERT into VaccinationCenters(Name, Lat, Lon, Info)
        values('$VaccinationCenterName', '$Latitude', '$Longitude', '$Information')");
        return $record;
    }

    // Function to add new hospital facility to the relevant hospital.
    public function insert_hfacility ($HospitalID, $FacilityID, $StartTime, $EndTime) { 
        $record = mysqli_query($this->db, "INSERT into FacilityManager (HospitalID, FacilityID, sTime, eTime)
        values('$HospitalID', '$FacilityID', '$StartTime', '$EndTime')");
        return $record;
    }

    // Function to add new hospital facility to the system.
    public function insert_facility ($FacilityName) {
        echo $FacilityName; 
        $record = mysqli_query($this->db, "INSERT into Facilities (FacilityName) values ('$FacilityName')");
        return $record;
    }




    // Function to check newly added hospital is duplicated or not.
    public function duplicate_hospital ($HospitalName){
        $duplicate = mysqli_query($this->db, " SELECT * from Hospitals where Name ='$HospitalName' and Availability = '1'");
        return (mysqli_num_rows($duplicate));
    }

    // Function to check newly added hospital clerk is duplicated or not.
    public function duplicate_clerk ($HClerkEmail){
        $duplicate = mysqli_query($this->db, " SELECT * from clerks where HClerkEmail ='$HClerkEmail' and Availability = '1'");
        return (mysqli_num_rows($duplicate));
    }

    // Function to check newly added vaccination center is duplicated or not.
    public function duplicate_vaccination_center ($VaccinationCenterName){
        $duplicate = mysqli_query($this->db, " SELECT * from VaccinationCenters where Name ='$VaccinationCenterName' and Availability = '1'");
        return (mysqli_num_rows($duplicate));
    }

    // Function to check newly added hospital facility is duplicated or not.
    public function duplicate_hfacility ($HospitalID, $FacilityID){
        $duplicate = mysqli_query($this->db, "SELECT * from FacilityManager where HospitalID = '$HospitalID' and FacilityID ='$FacilityID' and Availability = '1'");
        return (mysqli_num_rows($duplicate));
    }




    //Function to check newly added hospital is already removed from database or not.
    public function removed_hospital ($HospitalName){
        $removed = mysqli_query($this->db, " SELECT * from Hospitals where Name ='$HospitalName' and Availability = '0'");
        return (mysqli_num_rows($removed));
    }

    //Function to check newly added vaccination center is already removed from database or not.
    public function removed_vaccination ($VaccinationCenterName){
        $removed = mysqli_query($this->db, " SELECT * from VaccinationCenters where Name ='$VaccinationCenterName' and Availability = '0'");
        return (mysqli_num_rows($removed));
    }

    // Function to check newly added hospital facility is removed from relevant hospital before or not.
    public function removed_hfacility ($HospitalID, $FacilityID){
        $removed = mysqli_query($this->db, "SELECT * from FacilityManager where HospitalID = '$HospitalID' and FacilityID ='$FacilityID' and Availability = '0'");
        return (mysqli_num_rows($removed));
    }




    // Function to add already removed hospital clerk by making it available
    public function make_available_clerk ($HospitalID, $HClerkEmail) { 

        $query = " UPDATE clerks set HClerkEmail = ? , Availability = 1 where HospitalID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $HClerkEmail, $HospitalID);
        $stmt->execute();
        $stmt->close();

    }

    // Function to add already removed hospital by making it available
    public function make_available_hospital ($HospitalName, $District, $Information, $HospitalImage) { 

        mysqli_query($this->db, " UPDATE Hospitals set Address = '$District', Information = '$Information', 
        HospitalImage = '$HospitalImage' , Availability = 1 where Name = '$HospitalName' ");

    }


    // Function to add already removed vaccination center by making it available
    public function make_available_vaccination ($VaccinationCenterName) { 

        $query = " UPDATE VaccinationCenters set Availability = 1 where Name = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s',$VaccinationCenterName);
        $stmt->execute();
        $stmt->close();

    }

    // Function to add already removed hospital facility by making it available
    public function make_available_hfacility ($HospitalID, $FacilityID, $StartTime, $EndTime) { 

        $query = " UPDATE FacilityManager set Availability = 1 , sTime = ? , eTime = ? where HospitalID = ? and FacilityID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssii', $StartTime, $EndTime, $HospitalID, $FacilityID);
        $stmt->execute();
        $stmt->close();

    }



    public function check_hospitalID ($HospitalID) {
        $check = mysqli_query($this->db, " SELECT * from clerks where HospitalID ='$HospitalID' ");
        return (mysqli_num_rows($check));
    }




    // Function to retrieve hospital names from the database.
    public function fetch_hospital () { 
        $records = mysqli_query($this->db," SELECT Name from Hospitals where Availability = '1'");
        return $records;
    }

    // Function to retrieve vaccination center names from the database.
    public function fetch_vaccination () { 
        $records = mysqli_query($this->db," SELECT Name from VaccinationCenters where Availability = '1'");
        return $records;
    }

    // Function to retrieve facilities of the relevant hospital from the database.
    public function fetch_facility ($HospitalID) { 
        $records = mysqli_query($this->db,"SELECT FacilityID, sTime, eTime from FacilityManager where HospitalID = '$HospitalID' and Availability = '1'");
        return $records;
    }

    // Function to retrieve facility name from the database using facility ID.
    public function fetch_facilityName ($FacilityID) { 
        $facilityName = mysqli_query($this->db,"SELECT FacilityName from Facilities where FacilityID = $FacilityID");
        return $facilityName;
    }

    // Function to retrieve hospital name from the database using hospital ID.
    public function fetch_hospitalName ($HospitalID) {
        $hospitalName = mysqli_query($this->db,"SELECT Name from Hospitals where HospitalID = $HospitalID");
        return $hospitalName;
    }




    // Function to retrieve corresponding hospital id from the database using specific hospital name.
    public function fetch_hospitalID ($HospitalName) { 
        $HospitalName = trim($HospitalName);
        $HospitalID = mysqli_query($this->db," SELECT HospitalID from Hospitals where Name = '$HospitalName'");
        $row = $HospitalID -> fetch_assoc();
        return $row['HospitalID'];
    }

    // Function to retrieve corresponding facility ID from the database using specific facility name.
    public function fetch_facilityID ($FacilityName) {
        $FacilityName = trim($FacilityName);
        $FacilityID = mysqli_query($this->db," SELECT FacilityID from Facilities where FacilityName = '$FacilityName'");
        $row = $FacilityID -> fetch_assoc();
        return $row;

    }





    // Function to remove existing hospital by making it unavailable
    public function remove_hospital ($HospitalName) { 

        $query = "UPDATE Hospitals set Availability = 0 where Name = ?";
        $stmt = $this->db->prepare($query);
        $HospitalName = trim($HospitalName);
        $stmt->bind_param('s',$HospitalName);
        $stmt->execute();
        $stmt->close();

    }

    // Function to remove relevant existing hospital clerk by making it unavailable
    public function remove_clerk ($HospitalID) { 

        $query = "UPDATE clerks set Availability = 0 where HospitalID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i',$HospitalID);
        $stmt->execute();
        $stmt->close();

    }

    // Function to remove existing vaccination center by making it unavailable
    public function remove_vaccination ($VaccinationCenterName) {

        $query = " UPDATE VaccinationCenters set Availability = 0 where Name = ?";
        $stmt = $this->db->prepare($query);
        $VaccinationCenterName = trim($VaccinationCenterName);
        $stmt->bind_param('s',$VaccinationCenterName);
        $stmt->execute();
        $stmt->close();

    }

    // Function to remove existing facility of the relevant hospital by making it unavailable
    public function remove_facility ($HospitalID, $FacilityID) { 

        $query = " UPDATE FacilityManager set Availability = 0 where HospitalID = ? and FacilityID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $HospitalID, $FacilityID);
        $stmt->execute();
        $stmt->close();

    }




    // Function to update existing facility of the relevant hospital.
    public function update_hfacility ($HospitalID, $FacilityID, $StartTime, $EndTime) { 

        $query = " UPDATE FacilityManager set sTime = ? , eTime = ? where HospitalID = ? and FacilityID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssii', $StartTime, $EndTime, $HospitalID, $FacilityID);
        $stmt->execute();
        $stmt->close();


    }


    // Function to update emailing facility time slot of the users for the relevant hospital facility.
    public function update_time ($StartTime, $EndTime, $HospitalName, $FacilityName) { 

        $query = " UPDATE Users set sTime = ? , eTime = ? where HospitalName = ? and FacilityName = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $StartTime, $EndTime, $HospitalName, $FacilityName);
        $stmt->execute();
        $stmt->close();

    }




    // Function to retrieve user details who requested specific hospital facility notification.
    public function getUpdateMailUser($HospitalName, $FacilityName):array
    {
        $HospitalName = trim($HospitalName);
        $FacilityName = trim($FacilityName);

        $query = "SELECT Users.Email, Users.UserID FROM Users 
        WHERE Users.HospitalName = '$HospitalName' and Users.FacilityName = '$FacilityName' and Users.Message = 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($email, $id);
        
        $output = array();
        while($stmt->fetch()){
                array_push($output, array($email, $id));

        }

        while($this->db->more_results()){
            $this->db->next_result();
            $this->db->use_result();
        }

        return $output;

    }
    //================================================================
    public function get_hospital($id):string
    {
        $saved_data = "SELECT * FROM Hospitals WHERE HospitalID = $id AND Availability = 1 ";
        $result = mysqli_query($this->db, $saved_data)
        or die("connection Failed ");

        //data
        $hospital = mysqli_fetch_array($result); 
        return $hospital['Name'];  
    }

    public function get_clerk($ClerkEmail)
    {
        $saved_data = "SELECT * FROM clerks WHERE HClerkEmail = '$ClerkEmail'";
        
        
        //make quary
        $result = mysqli_query($this->db, $saved_data)
                    or die("connection Failed In getclerk ");
    
        
        //data
        $data_list = mysqli_fetch_array($result);
        if($data_list == null){
            return null;

        }
        else{return $data_list;}
        
    }

    public function update_password($upswd1, $email)
    {
        //$pass = Password@123
        $pass = password_hash($upswd1, PASSWORD_DEFAULT);
        $update = "UPDATE clerks SET ChangedPW = '$pass' WHERE HClerkEmail = '$email'";
        $result = mysqli_query($this->db, $update)
        or die("connection Failed ");
    }

}

?>