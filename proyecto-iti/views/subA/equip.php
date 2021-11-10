<?php require('../../init.php'); ?>
<?php
    if (isset($_SESSION) && !($_SESSION['subA'])) {
        header('Location: ../../');
    }

    if (isset($_GET['home'])) {
        header('Location: .');
    }

    if (isset($_GET['equip'])) {
        header('Location: equip.php');
    }

    if (isset($_GET['users'])) {
        header('Location: users.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/Siscoin_Icon_3.svg">
    <link rel="stylesheet" href="../css/styles_equip.css">
    <title>Equipment</title>
</head>
<body>
    <?php include('../extras/header_subA.html'); ?>
    <div class="container1">
    <div class="rEquip">
            <button class="lBtn">List All <i class="fas fa-align-left"></i></button>
        </div>
        <div class="tableEquip">
            <div class="table">
                <table>
                    <tr id="headertr">
                        <th class="id_th">ID</th>
                        <th class="desc_th">Descripción</th>
                        <th class="marca_th">Marca</th>
                        <th class="fecha_th">Adquirido</th>
                        <th class="estado_th">Estado</th>
                        <th class="lugar_th">Lugar</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous" async></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script type="module" src="../js/equip_sub.js"></script>
</body>
</html>