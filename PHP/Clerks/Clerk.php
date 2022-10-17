<?php   

//use MainClerk as GlobalMainClerk;
abstract class Clerk{
  private $name;
  private $Email;
  private $password;
  private $NewPass;
  private $ID;
  private $role;
  

  public function __construct($E , $P,$newP, $ID, $role) {
    //echo __CLASS__ . " initialize only once ";
      //$this->name = $name;
      $this->Email = $E;
      $this->password = $P;
      $this->NewPass = $newP;
      $this->role = $role;
      $this->ID = $ID;
     // $this->ID = $id;
    }
    public function get_name() {
      return $this->name;
    }
    public function get_Email() {
      return $this->Email;
    }
    public function get_DefaultPW() {
      return $this->password;
    }
    public function get_NewPW() {
      return $this->NewPass;
    }

    public function get_ID() {
      return $this->ID;
    }
    public function get_Role() {
      return $this->role;
    }


    public abstract function get_Page();


}

?>