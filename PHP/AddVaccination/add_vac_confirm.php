<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Vaccination Center</title>
    <link rel="stylesheet" href="../../CSS/add_vac.css" >
</head>
<body>

<script>
    if (confirm('Add Confirmation?')) {
        // Direct the page to add new vaccination center page.
        location.href = 'add_vaccination.php?name=<?= $_GET['name'] ?> & lat=<?= $_GET['lat'] ?> & lon=<?= $_GET['lon'] ?> & for=<?= $_GET['for'] ?>';
    } 
    else {
        if (confirm("Want to change the Vaccination Center Details?")) {
            location.href = '../../HTML/AddVaccination/add_vac.php'; // Direct the page to add vaccination center page.
        } else {
            location.href = '../../HTML/AdminPage/main_admin_home.php'; // Direct the page to main admin home page.
        }
    }
</script>

</body>
</html>