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
    <title>Add new hospital</title>
    <link rel="stylesheet" href="../../CSS/add_hos.css" />
  </head>
  <body>
    <form action="../../PHP/AddHospital/add_hos.php" method="POST">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" placeholder="Enter hospital's name.." />

      <label for="dis">District</label>
      <input type="text" id="dis" name="dis" placeholder="Enter hospital's district.."/>

      <label for="info">Information</label>
      <textarea id="for" name="for" placeholder="Say something about the hospital.."></textarea>

      <label for="email">Hospital Clerk Email</label>
      <input type="text" id="email" name="email" placeholder="Enter hospital clerk's E-mail address.."/>

      <label for="img">Image</label>
      <input type="file" id="img" name="img" />

      <button type="submit" class="submit">Submit </button>
      
    </form>
  </body>
</html>
