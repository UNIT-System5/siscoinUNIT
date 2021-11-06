<?php require(__DIR__ . '/../../init.php'); ?>
<?php
    if (isset($_SESSION) && !($_SESSION['admin'])) {
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
    <link rel="stylesheet" href="../css/styles.css">
    <title>Control de Inventario</title>
</head>
<body>
    <?php include('../extras/header_admin.html'); ?>
    <div class="container1">
        <div class="title1">
            <h2>Dashboard</h2>
        </div>
        <div class="cards">
            <div class="data_offices">
                <div class="card_content">
                    <div class="section1">
                        <h1>0</h1>
                        <span>Total offices</span>
                    </div>
                    <div class="section2">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
                <div class="card_info">
                    <a href="#">
                        More Info <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="data_equipment">
                <div class="card_content">
                    <div class="section1">
                        <h1>0</h1>
                        <span>Total equipment</span>
                    </div>
                    <div class="section2 equip">
                        <i class="fas fa-desktop"></i>
                    </div>
                </div>
                <div class="card_info equip">
                    <a href="?equip">
                        More Info <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="data_employees">
                <div class="card_content">
                    <div class="section1">
                        <h1>0</h1>
                        <span>Total employees</span>
                    </div>
                    <div class="section2 emp">
                        <i class="fas fa-user-alt"></i>
                    </div>
                </div>
                <div class="card_info emp">
                    <a href="?users">
                        More Info <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="data_fails">
                <div class="card_content">
                    <div class="section1">
                        <h1>0</h1>
                        <span>Total failures</span>
                    </div>
                    <div class="section2 fails">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <div class="card_info fails">
                    <a href="#">
                        More Info <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="separator2">
            <div class="separator_line">
            </div>
        </div>
        <div class="history">
            <div class="title2">
                <h2>Requests History</h2>
            </div>
            <div class="history_tab">
                <table>
                    <tr class="top-tr">
                        <th class="id_col"><i class="fas fa-hashtag"></i> ID</th>
                        <th class="tit_col"><i class="fas fa-quote-right"></i> Title</th>
                        <th class="desc_col"><i class="fas fa-align-left"></i> Description</th>
                        <th class="lugar_col"><i class="fas fa-building"></i> Office</th>
                        <th class="tipo_col"><i class="fas fa-desktop"></i> Equipment Type</th>
                        <th class="fecha_col"><i class="far fa-calendar"></i> Initial Date</th>
                        <th class="fehca_col_2"><i class="far fa-calendar-alt"></i> Final Date</th>
                    </tr>
                </table>
                <div class="history_full">
                    <a href="#">
                        View All <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous" async></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script type="module" src="../js/main.js"></script>
</body>
</html>
