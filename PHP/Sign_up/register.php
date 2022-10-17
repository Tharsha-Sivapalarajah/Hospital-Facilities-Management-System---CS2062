<?php


//require 'Email.php';
//require 'Password.php';
require 'validate.php';
require '../PHPMailer/credential.php';
require '../Result/Database.php';

session_start();
$email  = $_SESSION['email'];
$currentPW = $_SESSION['currentPW'];
$upswd1 = $_SESSION['upswd1'];


class Register {

  public function register_Me($currentPW,$email,$upswd1){

        $dataB = Database::getdb();
 
        $ClerkDetail = $dataB->get_clerk($email);
        if($ClerkDetail == null){
          echo "<script>alert('Password NOT Changed !!!');
          window.location.href='../../PHP/User_Login/login.php';</script>";

        }else{
          if($currentPW == "password"){
            $dataB->update_password($upswd1,$email);
            echo "<script>alert('Password Changed !!!');
            window.location.href='../../PHP/User_Login/login.php';</script>";
              
            }elseif($currentPW != "password"){
              if($currentPW == $ClerkDetail['ChangedPW']){
                $dataB->update_password($upswd1,$email);
                echo "<script>alert('Password Changed !!!');
                window.location.href='../../PHP/User_Login/login.php';</script>";
              }else{
                echo "<script>alert('Wrong Username or Password !!!');
                window.location.href='../../PHP/Sign_up/signup.php';</script>";
    
              }
          }

        }



              
    }
      
      

  
}

$register = new Register();
$register->register_Me($currentPW,$email,$upswd1);
?>