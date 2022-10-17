<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Existing Hospital Facility</title>
    <link rel="stylesheet" href="../../../CSS/del_hoss.css" >
</head>
<body>
<?php
     $HospitalName = $_GET['hname']; 
?>
<script>
    if (confirm('Delete Confirmation?')) {

        // Direct the page to delete relevant hospital facility page.
        location.href = 'del_hfacility.php?hid=<?= $_GET['hid'] ?> & fname=<?= $_GET['fname'] ?>';
    } 
    else {
        
        if (confirm("Want to change deleting facility?")) {
            location.href='../facilities_page.php?hospital= <?=$HospitalName?> ';
 // Direct the page to facility pae
        } else {
            location.href = '../../../HTML/AdminPage/sub_admin_home.php'; // Direct the page to sub admin home page.
        }
    }
</script>

</body>
</html>