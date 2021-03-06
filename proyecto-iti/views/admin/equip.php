<?php require('../../init.php'); ?>
<?php
    if (isset($_SESSION)) {
        if (!($_SESSION['admin'])) {
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
    <link rel="stylesheet" href="../css/styles_equip.css">
    <title>Equipment</title>
</head>
<body>
    <?php include('../extras/header_admin.html'); ?>
    <div class="container1">
        <div class="rEquip">
            <button class="rBtn">Request <i class="fas fa-plus"></i></button>
            <button class="aBtn">Add Type <i class="fas fa-plus"></i></button>
            <button class="lBtn">List Own <i class="fas fa-align-left"></i></button>
            <button class="tBtn">List Types <i class="fas fa-desktop"></i></button>
        </div>
        <div class="tableEquip">
            <div class="table">
                <table>
                    <tr id="headertr">
                        <th class="id_th">ID</th>
                        <th class="desc_th">Description</th>
                        <th class="marca_th">Brand</th>
                        <th class="guar_th">Warranty</th>
                        <th class="fecha_th">Acquired</th>
                        <th class="estado_th">Status</th>
                        <th class="lugar_th">Location</th>
                        <th class="actions_th"></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/moment.min.js"></script>
    <script src="../js/clamp.min.js"></script>
    <script type="module" src="../js/equip.js"></script>
</body>
</html>