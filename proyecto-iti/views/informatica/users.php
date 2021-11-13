<?php require('../../init.php'); ?>
<?php
    if (isset($_SESSION)) {
        if (!($_SESSION['info'])) {
            header('Location: ../../');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/Siscoin_Icon_3.svg">
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="../css/styles_users.css">
    <title>Users</title>
</head>
<body>
    <?php include('../extras/header_admin.html'); ?>
    <div class="container1">
    </div>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script type="module" src="../js/users.js"></script>
</body>
</html>