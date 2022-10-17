<?php 
//require_once '../Clerks/Clerk.php';
//require_once '../Clerks/MainClerk.php';

require_once '../PHPMailer/credential.php';
require_once '../Result/Database.php';
$ClerkEmail = $_POST['username'];
$pass = $_POST['pass_w'];
session_start();

//----------------------------
//----------------------------

class Logger{
    public $Admin;

    public function __construct($ClerkEmail){

        $dataB = Database::getdb();
        $data_list = $dataB->get_clerk($ClerkEmail);
        if($data_list == null){

        }

            
        elseif($data_list["Role"]== "Main Clerk"){
            require_once '../Clerks/MainClerk.php';
                $this->Admin = new MainClerk($data_list["HClerkEmail"],$data_list["DefaultPW"],$data_list["ChangedPW"],$data_list["HospitalID"],$data_list["Role"],$data_list["Logged"]);   
        }elseif($data_list["Role"]== "Hospital Clerk"){
                require_once '../Clerks/HospitalClerk.php';
                $this->Admin = new HospitalClerk($data_list["HClerkEmail"],$data_list["DefaultPW"],$data_list["ChangedPW"],$data_list["HospitalID"],$data_list["Role"],$data_list["Logged"]);
        }

        
        

    
    }

    public function validate_User($pass){
       /* echo "<br>";
        echo "validation on progress";
        echo "<br>";*/
        //$this->Admin->get_Email()== "Admin@gmail.com" && 
        
        if($pass == 'password' && $this->Admin->get_NewPW() == null ){
            $_SESSION['logged-in']=$this->Admin->get_Email();
            $_SESSION['role'] = $this->Admin->get_Role();

            echo "<script>alert('Change default password !!!');
                window.location.href='../Sign_up/signup.php';</script>"
                ;
        /*echo "<script>alert('Change default password !!!');</script>";
        header("location:../Sign_Up/signup.php");
        exit;*/
        
        }elseif($pass != 'password' && $this->Admin->get_NewPW() != null){
            $passw  = password_verify($pass , $this->Admin->get_NewPW() );
            if ($passw){
                //$_SESSION['auth'] = true;
                $_SESSION['logged-in']=$this->Admin->get_Email();
                $_SESSION['role'] = $this->Admin->get_Role();
                $this->Admin->get_Page();

            } else{
                echo "<script>alert('wrong username or password !!!');
                window.location.href='login.php';</script>"
                ;
                exit;
            }
        }else{
            echo "<script>alert('wrong username or password !!!');
            window.location.href='login.php';</script>"
            ;
        }
        

  
    }
     
}

$logger = new Logger($ClerkEmail);
if($logger->Admin != null){
    $logger->validate_User($pass);
}else{
    echo "<script>alert('wrong username or password !!!');
    window.location.href='../../PHP/User_Login/login.php';</script>"
    ;
    //header("location:../User_Login/login.php");
    //exit;
}

//echo "<script>alert('sucessfully!!!');</script>";

?>

</body>
</html>