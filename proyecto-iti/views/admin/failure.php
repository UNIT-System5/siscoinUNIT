<?php require('../../init.php'); ?>
<?php
    if (isset($_SESSION) && !($_SESSION['admin'])) {
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
    <link rel="stylesheet" href="../css/styles_failure.css">
    <title>Failures</title>
</head>
<body>
    <?php include('../extras/header_admin.html'); ?>
    <div class="container1">
        <div class="bAll">
            <button title="List All" class="lBtn">List All <i class="fas fa-align-left"></i></button>
        </div>
        <div class="tableEquip">
            <div class="table">
                <table class="firstTable">
                    <tr id="headertr">
                        <th title="Estado" class="st_col"><i class="fas fa-file-alt"></i></th>
                        <th class="id_col"><i class="fas fa-hashtag"></i> ID</th>
                        <th class="tipo_col"><i class="fas fa-desktop"></i> Equipment Type</th>
                        <th class="desc_col"><i class="fas fa-align-left"></i> Description</th>
                        <th class="lugar_col"><i class="fas fa-building"></i> Office</th>
                        <th class="fecha_col"><i class="far fa-calendar"></i> Initial Date</th>
                        <th class="fecha_col_2"><i class="far fa-calendar-alt"></i> Final Date</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous" async></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/clamp.min.js"></script>
    <script type="module" src="../js/failure.js"></script>
</body>
</html>