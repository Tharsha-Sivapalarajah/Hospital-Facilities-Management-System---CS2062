<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Existing Hospital</title>
    <link rel="stylesheet" href="../../CSS/del_hoss.css" >
</head>
<body>

<script>
    if (confirm('Delete Confirmation?')) {

        // Direct the page to delete hospital page.
        location.href = 'del_hospital.php?hospital=<?= $_GET['hospital'] ?>';
    } 
    else {
        
        if (confirm("Want to change the Hospital?")) {
            location.href = 'fetch_hos.php'; // Direct the page to delete hospital page.
        } else {
            location.href = '../../HTML/AdminPage/main_admin_home.php'; // Direct the page to main admin home page.
        }
    }
</script>

</body>
</html>