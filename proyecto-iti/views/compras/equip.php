<?php require(__DIR__ . '/../../init.php'); ?>
<?php
    if (isset($_SESSION)) {
        if (!($_SESSION['compras'])) {
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
    <link rel="stylesheet" href="../css/styles_equip_comp.css">
    <title>Equipment</title>
</head>
<body>
    <?php include('../extras/header_compras.html'); ?>
    <div class="container1">
        <div class="eBtns">
            <button title="Register Purchases" class="rPur">Register <i class="fas fa-shopping-cart"></i></button>
            <button title="Add Equipment" class="rEquip">Add Eq... <i class="fas fa-microchip"></i></button>
            <button title="Add Providers" class="rProv">Add Pr... <i class="fas fa-user-plus"></i></button>
            <button title="Add Brands" class="rBrand">Add Br... <i class="fas fa-tags"></i></button>
        </div>
        <div class="tableEquip">
            <div class="table">
                <table>
                    <tr class="top-tr">
                        <th class="id_th">ID</th>
                        <th class="desc_th">Description</th>
                        <th class="marca_th">Brand</th>
                        <th class="guar_th">Guarantee</th>
                        <th class="prov_th">Provider</th>
                        <th class="fecha_th">Acquired</th>
                        <th class="estado_th">Status</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script type="module" src="../js/equip_comp.js"></script>
</body>
</html>