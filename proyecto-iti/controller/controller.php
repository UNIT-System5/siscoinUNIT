<?php
    require(__DIR__ . '/../model/model.php');

    session_start();
    
    /**
    * @param array $config This is an associative array with all the
    * credentials to connect to the database.
    * Esto es un array asociativo con todas las credenciales para
    * conectarse a la base de datos.
    */
    $config = parse_ini_file(__DIR__ . '/../../private/config.ini');

    /**
     * @param $listUsers This list all the users from the getUserData function.
     * Esto lista todos los usuarios desde la función getUserData.
     */

    if (isset($_REQUEST['login'])) {
        $mail = $_REQUEST['mail'];
        $pass = $_REQUEST['pass'];

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
                    echo json_encode('correct');
                    break;
                case 'Informática':
                    $_SESSION['info'] = $mail;
                    echo json_encode('correct');
                    break;
                case 'Subdirección A':
                    $_SESSION['subA'] = $mail;
                    echo json_encode('correct');
                    break;
                case 'Subdirección B':
                    $_SESSION['subB'] = $mail;
                    echo json_encode('correct');
                    break;
                case 'Oficina':
                    $_SESSION['oficina'] = $mail;
                    echo json_encode('correct');
                    break;
                case 'Compras':
                    $_SESSION['compras'] = $mail;
                    echo json_encode('correct');
                    break;
                case 'Auditoría':
                    $_SESSION['auditoria'] = $mail;
                    echo json_encode('correct');
                    break;
            }
        } else {
            echo json_encode('error');
        }
    }

    if (isset($_SESSION['admin']) || isset($_SESSION['info'])) {
        $groupModel = new User();

        /**
        * @param $listGroups This list all the groups from the getGroupData function.
        * Esto lista todos los grupos desde la función getGrouprData.
        */
        
        if (isset($_REQUEST['userCount'])) {
            $userListModel = new User();
    
            $listUsers = $userListModel -> getUserWOffice($config['infoLogin'], $config['infoPass']);
            
            echo json_encode($listUsers);
        }

        if (isset($_REQUEST['getGroups'])) {
            $groupModel = new User();

            $getG = $groupModel -> getGroupData($config['infoLogin'], $config['infoPass']);

            echo json_encode($getG);
        }

        if (isset($_REQUEST['getOffice'])) {
            $getOfficeModel = new User();

            $listOffices = $getOfficeModel -> getOfficeData($config['infoLogin'], $config['infoPass']);

            echo json_encode($listOffices);
        }

        if (isset($_REQUEST['getUserS'])) {
            $id = $_REQUEST['id'];

            $nameSModel = new User();

            $getS = $nameSModel -> getUserSData($id, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getS);
        }

        if (isset($_REQUEST['getUserM'])) {
            $mail = $_REQUEST['mail'];

            $nameMModel = new User();

            $getM = $nameMModel -> getUserMData($mail, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getM);
        }

        if (isset($_REQUEST['getEquipT'])) {
            $typeModel = new User();

            $getT = $typeModel -> getEquipType($config['infoLogin'], $config['infoPass']);

            echo json_encode($getT);
        }

        if (isset($_REQUEST['mod'])) {
            $id = $_REQUEST['mod'];
            $fk_group = $_REQUEST['mGroup'];
            $mail = $_REQUEST['mMail'];
            $name = $_REQUEST['mName'];
            $fk_ofic = $_REQUEST['mOfic'];

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


            $modModel = new User();

            $updateU = $modModel -> modUser(
                $config['infoLogin'], $config['infoPass'],
                $id, $name, $mail, $group, $fk_ofic, $fk_group
            );
        }

        /**
         * This will create new users for the database.
         * Esto creará nuevos usuarios para la base de datos.
         */
        if (isset($_REQUEST['saveUser'])) {
            $mail = $_REQUEST['cMail'];
            $cPass = $_REQUEST['cPass'];
            $name = $_REQUEST['cName'];
            $fk_ofic = $_REQUEST['cOfic'];
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
                $config['infoLogin'], $config['infoPass'],
                $group, $mail, $pass, $name, $fk_ofic, $fk_group
            );
        }

        if (isset($_REQUEST['getCreate'])) {
            $getCGroupModel = new User();

            $listCGroups = $getCGroupModel -> getGroupData($config['infoLogin'], $config['infoPass']);

            echo json_encode($listCGroups);
        }

        if (isset($_REQUEST['delUser'])) {
            $code = $_REQUEST['delUser'];

            $delModel = new User();

            $delUser = $delModel -> deleteUser($config['infoLogin'], $config['infoPass'], $code);
        }

        if (isset($_REQUEST['listEquip'])) {
            $LEQ = new User();
    
            $lequip = $LEQ -> listEQ($config['infoLogin'], $config['infoPass']);

            echo json_encode($lequip);
        }
    }

    if (isset($_SESSION['admin'])) {
        if (isset($_FILES['file'])) {
            $idModel = new Login();
            $id = $idModel -> getIdUser($_SESSION['admin']);

            $file = $_FILES['file'];

            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileType = $file['type'];
            $fileError = $file['error'];

            $fileE = explode('.', $fileName);
            $fileExt = strtolower(end($fileE));

            if ($fileError == 0) {
                $picName = $id[0] . '.' . $fileExt;
                array_map('unlink', glob(__DIR__ . '/../profilePics/' . $id[0] . '.*'));
                move_uploaded_file($fileTmp, __DIR__ . '/../profilePics/' . $picName);

                $picModel = new User();
                $setPicPath = $picModel -> setPPic($config['infoLogin'], $config['infoPass'], $id[0], $picName);
            }
        }

        if (isset($_REQUEST['getSession'])) {
            $mail = $_SESSION['admin'];

            $nameModel = new User();

            $getName = $nameModel -> getUserName($mail, $config['dirLogin'], $config['dirPass']);

            echo json_encode($getName);
        }

        if (isset($_REQUEST['getMail'])) {
            $mail = $_SESSION['admin'];

            echo json_encode($mail);
        }
    }

    if (isset($_SESSION['info'])) {
        if (isset($_FILES['file'])) {
            $idModel = new Login();
            $id = $idModel -> getIdUser($_SESSION['info']);

            $file = $_FILES['file'];

            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileE = explode('.', $fileName);
            $fileExt = strtolower(end($fileE));

            if ($fileError == 0) {
                $picName = $id[0] . '.' . $fileExt;
                array_map('unlink', glob(__DIR__ . '/../profilePics/' . $id[0] . '.*'));
                move_uploaded_file($fileTmp, __DIR__ . '/../profilePics/' . $picName);

                $picModel = new User();
                $setPicPath = $picModel -> setPPic($config['infoLogin'], $config['infoPass'], $id[0], $picName);

                echo json_encode(TRUE);
            }
        }

        if (isset($_REQUEST['getSession'])) {
            $mail = $_SESSION['info'];

            $nameModel = new User();

            $getName = $nameModel -> getUserName($mail, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getName);
        }

        if (isset($_REQUEST['getMail'])) {
            $mail = $_SESSION['info'];

            echo json_encode($mail);
        }
    }

    if (isset($_SESSION['subA'])) {
        if (isset($_FILES['file'])) {
            $idModel = new Login();
            $id = $idModel -> getIdUser($_SESSION['subA']);

            $file = $_FILES['file'];

            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileE = explode('.', $fileName);
            $fileExt = strtolower(end($fileE));

            if ($fileError == 0) {
                $picName = $id[0] . '.' . $fileExt;
                array_map('unlink', glob(__DIR__ . '/../profilePics/' . $id[0] . '.*'));
                move_uploaded_file($fileTmp, __DIR__ . '/../profilePics/' . $picName);

                $picModel = new User();
                $setPicPath = $picModel -> setPPic($config['infoLogin'], $config['infoPass'], $id[0], $picName);

                echo json_encode(TRUE);
            }
        }
        
        if (isset($_REQUEST['getUserM'])) {
            $mail = $_REQUEST['mail'];

            $nameMModel = new User();

            $getM = $nameMModel -> getUserMData($mail, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getM);
        }

        if (isset($_REQUEST['getSession'])) {
            $mail = $_SESSION['subA'];

            $nameModel = new User();

            $getName = $nameModel -> getUserName($mail, $config['loginUser'], $config['loginPass']);

            echo json_encode($getName);
        }

        if (isset($_REQUEST['getMail'])) {
            $mail = $_SESSION['subA'];

            echo json_encode($mail);
        }

        if (isset($_REQUEST['getReq'])) {
            $reqModel = new User();

            $listReq = $reqModel -> getRequests($config['subALogin'], $config['subAPass']);

            echo json_encode($listReq);
        }

        if (isset($_REQUEST['changeSR'])) {
            $id = $_REQUEST['changeSR'];
            $state = $_REQUEST['state'];

            $changeModel = new User();

            $chState = $changeModel -> changeState($config['subALogin'], $config['subAPass'], $id, $state);
        }
    }

    if (isset($_SESSION['subB'])) {
        if (isset($_FILES['file'])) {
            $idModel = new Login();
            $id = $idModel -> getIdUser($_SESSION['subB']);

            $file = $_FILES['file'];

            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileE = explode('.', $fileName);
            $fileExt = strtolower(end($fileE));

            if ($fileError == 0) {
                $picName = $id[0] . '.' . $fileExt;
                array_map('unlink', glob(__DIR__ . '/../profilePics/' . $id[0] . '.*'));
                move_uploaded_file($fileTmp, __DIR__ . '/../profilePics/' . $picName);

                $picModel = new User();
                $setPicPath = $picModel -> setPPic($config['infoLogin'], $config['infoPass'], $id[0], $picName);

                echo json_encode(TRUE);
            }
        }

        if (isset($_REQUEST['getUserM'])) {
            $mail = $_REQUEST['mail'];

            $nameMModel = new User();

            $getM = $nameMModel -> getUserMData($mail, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getM);
        }

        if (isset($_REQUEST['getSession'])) {
            $mail = $_SESSION['subB'];

            $nameModel = new User();

            $getName = $nameModel -> getUserName($mail, $config['loginUser'], $config['loginPass']);

            echo json_encode($getName);
        }

        if (isset($_REQUEST['getMail'])) {
            $mail = $_SESSION['subB'];

            echo json_encode($mail);
        }
    }

    if (isset($_SESSION['oficina'])) {
        if (isset($_FILES['file'])) {
            $idModel = new Login();
            $id = $idModel -> getIdUser($_SESSION['oficina']);

            $file = $_FILES['file'];

            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileE = explode('.', $fileName);
            $fileExt = strtolower(end($fileE));

            if ($fileError == 0) {
                $picName = $id[0] . '.' . $fileExt;
                array_map('unlink', glob(__DIR__ . '/../profilePics/' . $id[0] . '.*'));
                move_uploaded_file($fileTmp, __DIR__ . '/../profilePics/' . $picName);

                $picModel = new User();
                $setPicPath = $picModel -> setPPic($config['infoLogin'], $config['infoPass'], $id[0], $picName);

                echo json_encode(TRUE);
            }
        }

        if (isset($_REQUEST['getUserM'])) {
            $mail = $_REQUEST['mail'];

            $nameMModel = new User();

            $getM = $nameMModel -> getUserMData($mail, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getM);
        }

        if (isset($_REQUEST['getSession'])) {
            $mail = $_SESSION['oficina'];

            $nameModel = new User();

            $getName = $nameModel -> getUserName($mail, $config['loginUser'], $config['loginPass']);

            echo json_encode($getName);
        }

        if (isset($_REQUEST['getMail'])) {
            $mail = $_SESSION['oficina'];

            echo json_encode($mail);
        }
    }

    if (isset($_SESSION['compras'])) {
        if (isset($_FILES['file'])) {
            $idModel = new Login();
            $id = $idModel -> getIdUser($_SESSION['compras']);

            $file = $_FILES['file'];

            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileE = explode('.', $fileName);
            $fileExt = strtolower(end($fileE));

            if ($fileError == 0) {
                $picName = $id[0] . '.' . $fileExt;
                array_map('unlink', glob(__DIR__ . '/../profilePics/' . $id[0] . '.*'));
                move_uploaded_file($fileTmp, __DIR__ . '/../profilePics/' . $picName);

                $picModel = new User();
                $setPicPath = $picModel -> setPPic($config['infoLogin'], $config['infoPass'], $id[0], $picName);

                echo json_encode(TRUE);
            }
        }

        if (isset($_REQUEST['getUserM'])) {
            $mail = $_REQUEST['mail'];

            $nameMModel = new User();

            $getM = $nameMModel -> getUserMData($mail, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getM);
        }

        if (isset($_REQUEST['getSession'])) {
            $mail = $_SESSION['compras'];

            $nameModel = new User();

            $getName = $nameModel -> getUserName($mail, $config['loginUser'], $config['loginPass']);

            echo json_encode($getName);
        }

        if (isset($_REQUEST['getMail'])) {
            $mail = $_SESSION['compras'];

            echo json_encode($mail);
        }
    }

    if (isset($_SESSION['auditoria'])) {
        if (isset($_FILES['file'])) {
            $idModel = new Login();
            $id = $idModel -> getIdUser($_SESSION['auditoria']);

            $file = $_FILES['file'];

            $fileName = $file['name'];
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];

            $fileE = explode('.', $fileName);
            $fileExt = strtolower(end($fileE));

            if ($fileError == 0) {
                $picName = $id[0] . '.' . $fileExt;
                array_map('unlink', glob(__DIR__ . '/../profilePics/' . $id[0] . '.*'));
                move_uploaded_file($fileTmp, __DIR__ . '/../profilePics/' . $picName);

                $picModel = new User();
                $setPicPath = $picModel -> setPPic($config['infoLogin'], $config['infoPass'], $id[0], $picName);

                echo json_encode(TRUE);
            }
        }

        if (isset($_REQUEST['getUserM'])) {
            $mail = $_REQUEST['mail'];

            $nameMModel = new User();

            $getM = $nameMModel -> getUserMData($mail, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getM);
        }

        if (isset($_REQUEST['getSession'])) {
            $mail = $_SESSION['auditoria'];

            $nameModel = new User();

            $getName = $nameModel -> getUserName($mail, $config['loginUser'], $config['loginPass']);

            echo json_encode($getName);
        }

        if (isset($_REQUEST['getMail'])) {
            $mail = $_SESSION['auditoria'];

            echo json_encode($mail);
        }
    }
     