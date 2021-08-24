<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="views/images/UNIT_Icon.png">
    <link rel="stylesheet" href="views/css/styles.css">
    <title>Control de Inventario</title>
</head>
<body>
    <div class="header">
        <div class="menu">
            <i class="fas fa-bars" onclick="MenuClick();"></i>
            <div class="leftbar">
                <div class="menu_item even">
                    <a href="#">
                        <i class="fas fa-home"></i><h2>Home</h2>
                    </a>
                </div>
                <div class="menu_item">
                    <a href="#">
                        <i class="fas fa-microchip"></i><h2>Equipment</h2>
                    </a>
                </div>
                <div class="menu_item even">
                    <a href="#">
                        <i class="fas fa-clock"></i><h2>History</h2>
                    </a>
                </div>
                <div class="menu_item">
                    <a href="#">
                        <i class="fas fa-tools"></i><h2>Admin Panel</h2>
                    </a>
                </div>
                <div class="menu_item even">
                    <a href="#">
                        <i class="fas fa-question-circle"></i><h2>Help</h2>
                    </a>
                </div>
                <div class="menu_item">
                    <a href="#">
                        <i class="fas fa-info-circle"></i><h2>About Us</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="logo">
            <img class="logoimg" src="views/images/UNIT_Logo_Web.png">
        </div>
        <div class="nav">
            <span class="separator"></span>
            <div class="searchbar">
                <input autocomplete="off" type="text" name="search">
                <i class="fas fa-search" onclick="searchBar();"></i>
            </div>
            <div class="signin" onclick="ProfileClick();">
                <img src="views/images/default-profile.png">
                <div class="menupfp">
                    <a href="views/login.html">
                        <h2>Sign In</h2>
                        <i class="fas fa-key"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container1">
        <div class="title1">
            <h2>Dashboard</h2>
        </div>
        <div class="cards">
            <div class="data_offices">
                <div class="card_content">
                    <div class="section1">
                        <h1>27</h1>
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
                        <h1>1104</h1>
                        <span>Total equipment</span>
                    </div>
                    <div class="section2 equip">
                        <i class="fas fa-desktop"></i>
                    </div>
                </div>
                <div class="card_info equip">
                    <a href="#">
                        More Info <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="data_employees">
                <div class="card_content">
                    <div class="section1">
                        <h1>3408</h1>
                        <span>Total employees</span>
                    </div>
                    <div class="section2 emp">
                        <i class="fas fa-user-alt"></i>
                    </div>
                </div>
                <div class="card_info emp">
                    <a href="#">
                        More Info <i class="fas fa-angle-right"></i>
                    </a>
                </div>
            </div>
            <div class="data_fails">
                <div class="card_content">
                    <div class="section1">
                        <h1>357</h1>
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
                <h2>Movement History</h2>
            </div>
            <div class="history_tab">
                <table>
                    <tr class="top-tr">
                        <th>Date</th>
                        <th>User</th>
                        <th>Action</th>
                        <th>Product</th>
                        <th>Client</th>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 22/07/2019</td>
                        <td><i class="fas fa-cog"></i> Mauricio Villarino</td>
                        <td><i class="fas fa-wrench"></i> Install</td>
                        <td><i class="fas fa-desktop"></i> RAM 2x16 DDR4 Crucial</td>
                        <td><i class="far fa-user"></i> Mónica González</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 15/11/2014</td>
                        <td><i class="fas fa-cog"></i> Romina Balbiani</td>
                        <td><i class="fas fa-times"></i> Fail</td>
                        <td><i class="fas fa-desktop"></i> Mouse & Keyboard Genius</td>
                        <td><i class="far fa-user"></i> Lucius Malfoy</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 03/09/2010</td>
                        <td><i class="fas fa-cog"></i> Gian Luca Porto</td>
                        <td><i class="fas fa-times"></i> Fail</td>
                        <td><i class="fas fa-desktop"></i> Cougar Power Supply</td>
                        <td><i class="far fa-user"></i> John Doe</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 27/07/2007</td>
                        <td><i class="fas fa-cog"></i> Gian Luca Porto</td>
                        <td><i class="fas fa-dollar-sign"></i> Sell</td>
                        <td><i class="fas fa-desktop"></i> RedDragon Power Supply</td>
                        <td><i class="far fa-user"></i> Lautaro Hinojosa</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 26/07/2007</td>
                        <td><i class="fas fa-cog"></i> Romina Balbiani</td>
                        <td><i class="fas fa-dollar-sign"></i> Sell</td>
                        <td><i class="fas fa-network-wired"></i> UTP 5e Cable (40m)</td>
                        <td><i class="far fa-user"></i> Ernesto False</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 10/05/2006</td>
                        <td><i class="fas fa-cog"></i> Mauricio Villarino</td>
                        <td><i class="fas fa-dollar-sign"></i> Sell</td>
                        <td><i class="fas fa-laptop"></i> Laptop HP Celeron</td>
                        <td><i class="far fa-user"></i> Camilo González</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 30/03/2005</td>
                        <td><i class="fas fa-cog"></i> Mauricio Villarino</td>
                        <td><i class="fas fa-dollar-sign"></i> Sell</td>
                        <td><i class="fab fa-playstation"></i> PlayStation 4, 1TB</td>
                        <td><i class="far fa-user"></i> Gian Luca Porto</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 30/03/2005</td>
                        <td><i class="fas fa-cog"></i> Mauricio Villarino</td>
                        <td><i class="fas fa-dollar-sign"></i> Sell</td>
                        <td><i class="fab fa-playstation"></i> PlayStation 4, 1TB</td>
                        <td><i class="far fa-user"></i> Gian Luca Porto</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 30/03/2005</td>
                        <td><i class="fas fa-cog"></i> Mauricio Villarino</td>
                        <td><i class="fas fa-dollar-sign"></i> Sell</td>
                        <td><i class="fab fa-playstation"></i> PlayStation 4, 1TB</td>
                        <td><i class="far fa-user"></i> Gian Luca Porto</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-alt"></i> 30/03/2005</td>
                        <td><i class="fas fa-cog"></i> Mauricio Villarino</td>
                        <td><i class="fas fa-dollar-sign"></i> Sell</td>
                        <td><i class="fab fa-playstation"></i> PlayStation 4, 1TB</td>
                        <td><i class="far fa-user"></i> Gian Luca Porto</td>
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
    <script src="views/js/script.js"></script>
</body>
</html>