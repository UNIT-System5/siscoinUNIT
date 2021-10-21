<?php require(__DIR__ . '/../../init.php'); ?>
<?php
    if (isset($_SESSION) && !($_SESSION['compras'])) {
        header('Location: ../../');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/Siscoin_Icon_3.svg">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Inicio</title>
</head>
<body>
    <?php include('../extras/header_admin.html'); ?>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous" async></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script type="module" src="../js/main.js"></script>
</body>
</html>