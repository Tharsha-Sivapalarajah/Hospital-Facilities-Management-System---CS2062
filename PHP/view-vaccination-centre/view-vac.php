<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Centers</title>
    <link rel="stylesheet" href="../../CSS/view-vac.css"> 
</head>
<body>
    <div class="color-layer">
        <h2 class="heading">Near by Vaccination Centres</h2>
    </div>
    <div id="map">

    </div>
    <?php
        
        require_once('../PHPMailer/credential.php');
        require_once("../Result/Database.php");

         $db = Database::getdb();
     
         $records = $db->fetch_vac();

        $locations = mysqli_fetch_all ($records, MYSQLI_ASSOC);
        //echo json_encode($locations );
        

  ?>
    <script>
        var geoJson = <?php echo json_encode($locations );?>;
        



    </script>   
    <script src="../../JScript/view-vac.js" ></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC-Wq3rRhcjAgKGEy8f5PHuASGhKVVAqBk&callback=initMap&v=weekly"
      async
    ></script>
</body>
</html>