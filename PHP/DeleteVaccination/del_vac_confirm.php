<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Existing Vaccination Center</title>
    <link rel="stylesheet" href="../../CSS/del_vac.css" >
</head>
<body>

<script>
    if (confirm('Delete Confirmation?')) {

        // Direct the page to delete vaccination center page.
        location.href = 'del_vaccination.php?vaccination=<?= $_GET['vaccination'] ?>';
    } 
    else {
        
        if (confirm("Want to change the Vaccination Center?")) {
            location.href = 'fetch_vac.php'; // Direct the page to delete vaccination center page.
        } else {
            location.href = '../../HTML/AdminPage/main_admin_home.php'; // Direct the page to main admin home page.
        }
    }
</script>

</body>
</html>