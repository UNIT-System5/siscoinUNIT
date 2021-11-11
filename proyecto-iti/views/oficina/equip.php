<?php require('../../init.php'); ?>
<?php
    if (isset($_SESSION) && !($_SESSION['oficina'])) {
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
    <link rel="stylesheet" href="../css/styles_equip_ofic.css">
    <title>Equipment</title>
</head>
<body>
    <?php include('../extras/header_oficina.html'); ?>
    <div class="container1">
        <div class="rEquip">
            <button title="Request Equipment" class="rBtn">Request <i class="fas fa-plus"></i></button>
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
                        <th class="fail_th">Fail</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous" async></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script type="module" src="../js/equip_ofic.js"></script>
</body>
</html>