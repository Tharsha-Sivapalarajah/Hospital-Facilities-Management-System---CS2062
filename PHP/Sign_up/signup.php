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
    <link rel="stylesheet" href="../User_Login/login.css">
    <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
    <form class = "login-box" action="signup.php" method="POST">
        <h1>Reset Password</h1>
        
        <?php
            if(isset($_POST['email']) && isset($_POST['currentPW']) && isset($_POST['upswd1']) && isset($_POST['upswd2'])){
                $p1 = $_POST['upswd1'];
                $p2 = $_POST['upswd2'];
                $email = $_POST['email'];
                $currentPW = $_POST['currentPW'];
                if($p1 != $p2){
                    echo "<b style=\"color:red;\">NEW PASSWORDS DID NOT MATCH!!!</b>";
                    
                }else{
                    if($p1 == $currentPW){
                            echo "<b style=\"color:red;\">OLD AND NEW PASSWORDS ARE SAME!!!</b>";
                    }else{
                        require 'validate.php';

                        $password_checker = new Password_validater();
                        if($password_checker->validate_Me($p1)){
                            //session_start();
                            $_SESSION['email'] = $email;
                            $_SESSION['currentPW'] = $currentPW;
                            $_SESSION['upswd1'] = $p1;
                            //$_SESSION['$email'] = $email;
                            header("location:register.php");
                            exit;

                        }
                    }
                        
                }
            }else{
                echo "<b style=\"color:red;\">PASSWORD MUST CONTAIN :-
                                <ul>
                                <li>ATLEST 8 CHARACTERS</li>
                                <li>DIFFERENT CASES</li>
                                <li>SPECIAL CHARACTORS</li>
                                </ul>  
                                </b>
                               ";


            }
        ?>
        <div class="textbox">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <input type="email" placeholder="Email_ID" name="email" required >
        </div>
        <div class="textbox">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" id="password1" placeholder="CurrentPassword" name="currentPW" required >
            <span>
                <i class="fa fa-eye" aria-hidden="true" id = "eye1" onclick="toggle1()"></i>
        </span>
        </div>
        <div class="textbox">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" id="password2" placeholder="NewPassword" name="upswd1" required >
            <span>
                <i class="fa fa-eye" aria-hidden="true" id = "eye2" onclick="toggle2()"></i>
        </span>
        </div>
        <div class="textbox">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" id="password3" placeholder="Re-Enter Password" name="upswd2" required >
            <span>
                <i class="fa fa-eye" aria-hidden="true" id = "eye3" onclick="toggle3()"></i>
        </span>
        </div>
        <input class = "butt" type="submit" id="btn1" name = "button" value="Change">
       
    </form>
</div> 

<script src="../User_Login/func.js"></script>
</body>
</html>