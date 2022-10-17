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
    <title>Add Vaccination Centre</title>
    <link rel="stylesheet" href="../../CSS/add_vac.css" />
  </head>
  <body>
    <form action="../../PHP/AddVaccination/add_vac.php" method="POST">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" placeholder="Enter Vaccination centre's name.." />

      <label for="lat">Lattitude</label>
      <input type="text" id="lat" name="lat" placeholder="Eg:77.4977" />
      
      <label for="lon">Longitude</label>
      <input type="text" id="lon" name="lon" placeholder="Eg:27.2046" />
      
      <label for="info">Information</label>
      <textarea id="for" name="for" placeholder="Say something about the Vaccination Centre.."></textarea>

      
      
      <button type="submit" class="submit">Submit </button>
      
    </form>
    <div id="map"></div>
    <script src="../../JScript/add_vac.js"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-Wq3rRhcjAgKGEy8f5PHuASGhKVVAqBk&callback=initMap&v=weekly"
      async
    ></script>

  </body>
</html>
