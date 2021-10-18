<?php require('../../init.php'); ?>
<?php
    if (isset($_SESSION) && !($_SESSION['admin'])) {
        header('Location: ../../');
    }

    if (isset($_GET['home'])) {
        header('Location: .');
    }

    if (isset($_GET['equip'])) {
        header('Location: equipment.php');
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
    <?php include('../extras/header_admin.html'); ?>
    <div class="container1">
        <div class="rEquip">
            <button class="rBtn">Request<i class="fas fa-plus"></i></button>
        </div>
        <div class="tableEquip">
            <div class="table">
                <table>
                    <tr>
                        <th class="id_th">ID</th>
                        <th class="desc_th">Descripción</th>
                        <th class="marca_th">Marca</th>
                        <th class="fecha_th">Adquirido</th>
                        <th class="estado_th">Estado</th>
                        <th class="lugar_th">Lugar</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Teclado</td>
                        <td>Sony Interactive Entertainment</td>
                        <td>10/10/2021</td>
                        <td>Instalado</td>
                        <td>Oficina Número 1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Mouse</td>
                        <td>Logitech</td>
                        <td>02/07/2020</td>
                        <td>Stock</td>
                        <td>Oficina Número 5</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Tarjeta de Video</td>
                        <td>NVIDIA</td>
                        <td>11/01/2021</td>
                        <td>Taller</td>
                        <td>Oficina Número 3</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous" async></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script type="module" src="../js/equip.js"></script>
</body>
</html>