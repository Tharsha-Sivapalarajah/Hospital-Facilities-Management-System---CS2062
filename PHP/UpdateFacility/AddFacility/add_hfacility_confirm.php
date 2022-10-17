

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Hospital Facility</title>
    <link rel="stylesheet" href="../../../CSS/del_hoss.css" >
</head>
<body>

<?php
     $HospitalName = $_GET['hname']; 
?>
<script>
    if (confirm('Add Confirmation?')) {

        // Direct the page to add new hospital facility page.
        location.href = 'add_hfacility.php?&hid=<?= $_GET['hid'] ?> & fid=<?= $_GET['fid'] ?> & stime=<?= $_GET['stime'] ?> & etime=<?= $_GET['etime'] ?> ';
    } 
    else {
        
        if (confirm("Want to change the Hospital Facility?")) {
            location.href='../facilities_page.php?hospital= <?=$HospitalName?> ';
        } else {
            location.href = '../../../HTML/AdminPage/sub_admin_home.php'; // Direct the page to sub admin home page.
        }
    }
</script>

</body>
</html>