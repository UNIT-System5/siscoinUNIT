<?php require(__DIR__ .  '/init.php'); ?>
<?php
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: .');
    }

    $roles = [
        'admin' => 'views/admin/',
        'info' => 'views/informatica/',
        'subA' => 'views/subA/',
        'subB' => 'views/subB/',
        'oficina' => 'views/oficina/',
        'compras' => 'views/compras/',
        'auditoria' => 'views/auditoria/',
    ];

    foreach ($roles as $r => $location) {
        if (isset($_SESSION[$r])) {
            header('Location: ' . $location);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="views/images/Siscoin_Icon_3.svg">
    <link rel="stylesheet" href="views/css/styles2.css">
    <title>Login</title>
</head>
<body>
    <div class="container1">
        <div class="errM" tabindex="0">
            <i class="fas fa-times"></i>
            <h2></h2>
        </div>
        <img src="views/images/it_login.webp" class="bgimg">
        <div class="imglogin">
            <img src="views/images/it_login.webp">
        </div>
        <div class="login_card">
            <div class="section1">
                <div class="pfp">
                    <img src="views/images/Siscoin_Logo_Compact.svg">
                </div> 
            </div>
            <div class="section2">
                <form action="init.php" method="POST">
                    <input required name="mail" class="mail" type="email" placeholder="E-Mail" maxlength="35">
                    <div class="input_pass">
                        <input required name="pass" type="password" placeholder="Password"
                        class="password" maxlength="24">
                        <button type="button" class="showPass" id="idk">
                            <i class="fas fa-eye-slash" id="iconEye"></i>
                        </button>
                    </div>
                    <button type="submit" name="login">Sign In <i class="fas fa-lock"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script src="views/js/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous"></script>
    <script src="views/js/login.js"></script>
    <?php if (isset($_GET['loginFailed'])) { ?>
        <script>
            alert("Correo o contraseña incorrectos");
        </script>
    <?php } ?>
</body>
</html>
