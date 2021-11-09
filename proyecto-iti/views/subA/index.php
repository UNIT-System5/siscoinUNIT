<?php require(__DIR__ . '/../../init.php'); ?>
<?php
    if (isset($_SESSION) && !($_SESSION['subA'])) {
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
    <link rel="stylesheet" href="../css/styles_sub.css">
    <title>Inicio</title>
</head>
<body>
    <?php include('../extras/header_subA.html'); ?>
    <div class="container1">
        <div class="title1">
            <h2>Dashboard</h2>
        </div>
        <div class="cards">
            <div class="data_offices">
                <div class="card_content">
                    <div class="section1">
                        <h1>0</h1>
                        <span>Total Offices</span>
                    </div>
                    <div class="section2">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
                <div class="card_info">
                    <a href="office.php">
                        More Info <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="data_equipment">
                <div class="card_content">
                    <div class="section1">
                        <h1>0</h1>
                        <span>Installed Equipment</span>
                    </div>
                    <div class="section2">
                        <i class="fas fa-desktop"></i>
                    </div>
                </div>
                <div class="card_info equip">
                    <a href="equip.php">
                        More Info <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="data_requests">
                <div class="card_content">
                    <div class="section1">
                        <h1>0</h1>
                        <span>Pending Requests</span>
                    </div>
                    <div class="section2">
                        <i class="fas fa-file-signature"></i>
                    </div>
                </div>
                <div class="card_info req">
                    <a href="request.php">
                        More Info <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="separator2">
            <div class="separator_line"></div>
        </div>
        <div class="requestValidator">
        </div>
    </div>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous" async></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/clamp.min.js"></script>
    <script type="module" src="../js/main_Sub.js"></script>
</body>
</html>