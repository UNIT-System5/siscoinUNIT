<?php require('../../init.php'); ?>
<?php
    if (isset($_SESSION)) {
        if (!($_SESSION['subB'])) {
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
    <link rel="stylesheet" href="../css/styles_office_subB.css">
    <title>Offices</title>
</head>
<body>
    <?php include('../extras/header_subB.html'); ?>
    <div class="container1">
        <div class="rOffic">
            <button class="aOffic" type="button">List All <i class="fas fa-align-left"></i></button>
        </div>
        <div class="tableEquip">
            <div class="table">
                <table class="firstTable">
                    <tr id="headertr">
                        <th class="id_col"><i class="fas fa-hashtag"></i> ID</th>
                        <th class="name_col"><i class="fas fa-building"></i> Name</th>
                        <th class="group_col"><i class="fas fa-users"></i> Group</th>
                        <th class="dep_col"><i class="fas fa-map"></i> Department</th>
                        <th class="city_col"><i class="fas fa-map-marker-alt"></i> City</th>
                        <th class="dir_col"><i class="fas fa-map-pin"></i> Address</th>
                        <th class="tel_col"><i class="fas fa-phone-alt"></i> Phone</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/clamp.min.js"></script>
    <script type="module" src="../js/office_subB.js"></script>
</body>
</html>