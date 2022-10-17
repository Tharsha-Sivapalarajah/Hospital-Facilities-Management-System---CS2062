<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../CSS/hospital_style.css" />
    <title>Facility Detail</title>
</head>
<body>
    <?php
    require_once 'Database.php';
    require_once 'Hospital.php';
    // require_once 'resultData.php';
    require_once '../PHPMailer/credential.php';

    define("HOSPITAL", $_REQUEST['hos']);
    define("FACILITY", $_REQUEST['fac']);
    class ResultPage
    {
        private Hospital $hospital;
        private Database $db;
        public function __construct()
        {
            $this->db = Database::getdb();
            $this->hospital = $this->getHospital(HOSPITAL);
            
        }

        private function getHospital(string $hospitalName):Hospital
        {
            return $this->db->getHospital($hospitalName);
        }

        public function getPage()
        {
            return $this->hospital->display(FACILITY);
        }
    }
    $resultPage = new ResultPage();
    echo $resultPage->getPage();
    // json_encode($resultPage->displayPage());

        
    //echo json_encode($_REQUEST);
    
    // print_r($_REQUEST);
    // echo "Success";

    echo "<script src=\"../../JScript/jquery-3.6.0.min.js\"></script>";
    echo "<script type=\"module\" src=\"../../JScript/resultScript.js\"></script>";
    ?>

</body>
</html>