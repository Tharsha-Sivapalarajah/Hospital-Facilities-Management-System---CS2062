<?php
require 'Clerk.php';

class MainClerk extends Clerk{

    
    public function get_Page(){
        //return $this -> page;
        //header("location:login.html");
        header("location:../../HTML/AdminPage/main_admin_home.php");

    }


}
//$clerktest = new MainClerk("vinojith","vino@17","u");
//$clerktest = new MainClerk()
//$clerktest->setDetails("vinojith","vino@17","u");
?>