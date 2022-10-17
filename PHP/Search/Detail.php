<?php

require_once '../Result/Database.php';
require_once '../PHPMailer/credential.php';

class Detail 
{
  private Database $db;
  private array $districtList;
  private array $hospitalList;
  private array $facilityList;

  
  public function __construct()
  {
    $this->db = Database::getdb();
    $this->districtList = array();
    $this->hospitalList = array();
    $this->facilityList = array();
    $this->setList();
  }

  private function setList()
  {
    $detailList = $this->db->getSearchableDetails();
    foreach ($detailList as $detail) {
      $districtName = $detail[0];
      $hospitalName = $detail[1];
      $facilityName = $detail[2];
      
      if(!in_array($districtName, $this->districtList)){
        $this->districtList[] = $districtName;
      }
      if(!in_array([$hospitalName, $districtName], $this->hospitalList)){
        $this->hospitalList[] = [$hospitalName, $districtName];
      }
      if(!in_array($facilityName, $this->facilityList)){
        $this->facilityList[] = $facilityName;
      }
    }
  }

  public function getDistrictList():array
  {
    return $this->districtList;
  }

  public function getHospitalList():array
  {
    return $this->hospitalList;
  }

  public function getFacilityList():array
  {
    return $this->facilityList;
  }

}


?>