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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>admin home</title>
    <link rel="stylesheet" href="../../CSS/admin_home_style.css" />
  </head>
  <body>
    <div class="banner">
      <header>
        <button class="log-out" onclick="window.location.href='../../PHP/Search/Home.php';">Log out</button>
        <button class="ch-pass" onclick="window.location.href='../../PHP/Sign_up/signup.php';">change password</button>

      </header>
    </div>
    <div class="container">
      <?php
      //session_start();
      $hospital = $_SESSION["hoss"];
      //echo "<button class=\"option\">".$hospital."</button>";
      //PHP/UpdateFacility/update_fetch_hospitals.php

      echo "<button class=\"option\" onclick=\"window.location.href='../../PHP/UpdateFacility/facilities_page.php?hospital= ".$hospital." '\">Update Facility</button>"
      ?>
      
      <!-- <button class="option" onclick="window.location.href='../../PHP/Sign_up/signup.php';">Change Password</button> -->
    </div>
  </body>
</html>
