<?php
    require(__DIR__ . '/../model/model.php');

    session_start();

    $userModel = new Login();

    /**
     * @param $listUsers This list all the users from the getUserData function.
     * Esto lista todos los usuarios desde la función getUserData.
     */
    $listUsers = $userModel -> getUserData();

    if (isset($_REQUEST['login'])) {
        $mail = $_REQUEST['mail'];
        $pass = $_REQUEST['pass'];
        $key = $_REQUEST['key'];

        $loginModel = new Login();
        $check = $loginModel -> checkUser($mail);

        /**
         * This checks if the password from the database matches with the
         * password provided by the user. If the password matches, then
         * the group will be verified to send the user to the correspond
         * website.
         * Esto chequea si la contraseña de la base de datos coincide con
         * la contraseña provista por el usuario. Si la contraseña coincide,
         * el grupo se verificará para enviar al usuario al sitio web
         * correspondiente.
         */
        if (password_verify($pass, $check[1])) {
            switch ($check[0]) {
                case 'Director':
                    $_SESSION['admin'] = $mail;
                    header('Location: views/admin/');
                    break;
                case 'Informática':
                    $_SESSION['info'] = $mail;
                    header('Location: views/info/');
                    break;
                case 'Subdirección A':
                    $_SESSION['subA'] = $mail;
                    header('Location: views/subA/');
                    break;
                case 'Subdirección B':
                    $_SESSION['subB'] = $mail;
                    header('Location: views/subB/');
                    break;
                case 'Oficina':
                    $_SESSION['oficina'] = $mail;
                    header('Location: views/oficina/');
                    break;
                case 'Compras':
                    $_SESSION['compras'] = $mail;
                    header('Location: views/compras/');
                    break;
                case 'Auditoría':
                    $_SESSION['auditoria'] = $mail;
                    header('Location: views/auditoria/p');
                    break;
            }
        } else {
            header('Location: ?loginFailed');
        }
    }

    if (isset($_SESSION['admin']) || isset($_SESSION['info'])) {
        $groupModel = new User();

        /**
         * @param array $config This is an associative array with all the
         * credentials to connect to the database.
         * Esto es un array asociativo con todas las credenciales para
         * conectarse a la base de datos.
         */
        $config = parse_ini_file(__DIR__ . '/../../private/config.ini');

        /**
        * @param $listGroups This list all the groups from the getGroupData function.
        * Esto lista todos los grupos desde la función getGrouprData.
        */
        $listGroups = $groupModel -> getGroupData($config['infoLogin'], $config['infoPass']); 

        /**
         * This will create new users for the database.
         * Esto creará nuevos usuarios para la base de datos.
         */
        if (isset($_REQUEST['saveUser'])) {
            $mail = $_REQUEST['cMail'];
            $cPass = $_REQUEST['cPass'];
            $name = $_REQUEST['cName'];
            $fk_group = $_REQUEST['cGroup'];
            $pass = password_hash($cPass, PASSWORD_BCRYPT);

            switch ($fk_group) {
                case '1':
                    $group = 'Director';
                    break;
                
                case '2':
                    $group = 'Informática';
                    break;
                
                case '3':
                    $group = 'Subdirección A';
                    break;
                
                case '4':
                    $group = 'Subdirección B';
                    break;
                
                case '5':
                    $group = 'Oficina';
                    break;
                
                case '6':
                    $group = 'Compras';
                    break;

                case '7':
                    $group = 'Auditoría';
                    break;
            }

            $userModel = new User();

            $createUser = $userModel -> createUser(
                $config['dirLogin'], $config['dirPass'],
                $group, $mail, $pass, $name, $fk_group
            );

            header('Location: ?created');
        }
    }

    