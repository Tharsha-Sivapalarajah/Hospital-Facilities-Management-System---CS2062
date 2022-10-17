<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Hospital</title>
    <link rel="stylesheet" href="../../CSS/add_hos.css" >
</head>
<body>

<script>
    if (confirm('Add Confirmation?')) {

        // Direct the page to add new hospital page.
        location.href = 'add_hospital.php?hos=<?= $_GET['hos'] ?> & dis=<?= $_GET['dis'] ?> & info=<?= $_GET['info'] ?> & email=<?= $_GET['email'] ?> & img=<?= $_GET['img'] ?>';
    } 
    else {
        
        if (confirm("Want to change the Hospital Details?")) {
            location.href = '../../HTML/AddHospital/add_hos.php'; // Direct the page to add hospital page.
        } else {
            location.href = '../../HTML/AdminPage/main_admin_home.php'; // Direct the page to main admin home page.
        }
    }
</script>

</body>
</html>