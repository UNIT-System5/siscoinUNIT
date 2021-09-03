<?php require(__DIR__ .  '/init.php'); ?>
<?php
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: .');
    }
    
    if (isset($_SESSION['admin'])) {
        header('Location: views/admin/');
    }

    if (isset($_SESSION['info'])) {
        header('Location: views/informatica/');
    }

    if (isset($_SESSION['subA'])) {
        header('Location: views/subA/');
    }

    if (isset($_SESSION['subB'])) {
        header('Location: views/subB/');
    }

    if (isset($_SESSION['oficina'])) {
        header('Location: views/oficina/');
    }

    if (isset($_SESSION['compras'])) {
        header('Location: views/compras/');
    }

    if (isset($_SESSION['auditoria'])) {
        header('Location: views/auditoria/');
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
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <input required name="mail" type="email" placeholder="E-Mail" maxlength="35">
                    <div class="input_pass">
                        <input required name="pass" type="password" placeholder="Password" class="password" maxlength="24">
                        <input type="hidden" name="key" value="<?php echo md5('login' . date('H:i')); ?>">
                        <button type="button" class="showPass" id="idk" onclick="viewPass();">
                            <i class="fas fa-eye-slash" id="uwu"></i>
                        </button>
                    </div>
                    <button type="submit" name="login">Sign In <i class="fas fa-lock"></i></button>
                </form>
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/84614effd5.js" crossorigin="anonymous"></script>
    <script src="views/js/script.js"></script>
    <?php if (isset($_GET['loginFailed'])) { ?>
        <script>
            alert("Correo o contraseña incorrectos");
        </script>
    <?php } ?>
</body>
</html>
