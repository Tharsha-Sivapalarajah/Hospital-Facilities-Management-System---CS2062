<?php
interface validater{
    public function validate_Me($input);

}


class MailValidator implements validater {
    public function validate_Me($email){

        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
        if (preg_match($regex, $email)) {
            echo "<script>alert('Invalid Email!!!!');</script>";
        } else { 
            return true;
        } 

    }
}

class Password_validater implements validater{
    public function validate_Me($password){
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $special = preg_match('/[#$@!%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/',  $password);


        if(strlen($password) < 8){
            echo "<b style=\"color:red;\">PASSWORD MUST CONTAIN 8 CHARACTERS!!!</b>";
        }elseif(!$uppercase){
            echo "<b style=\"color:red;\">PASSWORD MUST CONTAIN UPPERCASE!!!</b>";
        }elseif(!$lowercase){
            echo "<b style=\"color:red;\">PASSWORD MUST CONTAIN LOWERCASE!!!</b>";
        }elseif(!$number){
            echo "<b style=\"color:red;\">PASSWORD MUST CONTAIN A NUMBER!!!</b>";
        }elseif(!$special){
            echo "<b style=\"color:red;\">PASSWORD MUST CONTAIN A SPECIAL CHARACHTER!!!</b>";
        }else{return true;}
    }
}

?>