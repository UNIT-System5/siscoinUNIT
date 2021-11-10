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

        if (isset($_REQUEST['getDepart'])) {
            $departModel = new User();

            $getDep = $departModel -> getDepartData($config['infoLogin'], $config['infoPass']);

            echo json_encode($getDep);
        }

        if (isset($_REQUEST['getOffice'])) {
            $getOfficeModel = new User();

            $listOffices = $getOfficeModel -> getOfficeData($config['infoLogin'], $config['infoPass']);

            echo json_encode($listOffices);
        }

        if (isset($_REQUEST['getOfficeS'])) {
            $getOffSM = new User();

            $getOfficeS = $getOffSM -> getOfficeS($config['infoLogin'], $config['infoPass']);

            echo json_encode($getOfficeS);
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

        if (isset($_REQUEST['getEquipTotal'])) {
            $typeSModel = new User();

            $getTS = $typeSModel -> getEquipTotal($config['infoLogin'], $config['infoPass']);

            echo json_encode($getTS);
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

        if (isset($_REQUEST['getOWG'])) {
            $id = $_REQUEST['id'];

            $offGM = new User();

            $gOWG = $offGM -> getOfficeFG($config['infoLogin'], $config['infoPass'], $id);

            echo json_encode($gOWG);
        }

        if (isset($_REQUEST['listEquip'])) {
            $LEQ = new User();
    
            $lequip = $LEQ -> listEQ($config['infoLogin'], $config['infoPass']);

            echo json_encode($lequip);
        }

        if (isset($_REQUEST['listEquipFID'])) {
            $id = $_REQUEST['idEq'];

            $lEqFIDM = new User();
            $lEqFID = $lEqFIDM -> listEqFID($config['infoLogin'], $config['infoPass'], $id);

            echo json_encode($lEqFID);
        }

        if (isset($_REQUEST['listSol'])) {
            $lSolM = new User();

            $lSol = $lSolM -> getSolInfo($config['infoLogin'], $config['infoPass']);

            echo json_encode($lSol);
        }

        if (isset($_REQUEST['listSolP'])) {
            $lSolPM = new User();

            $lSolP = $lSolPM -> getSolPInfo($config['infoLogin'], $config['infoPass']);

            echo json_encode($lSolP);
        }

        if (isset($_REQUEST['listEquipFO'])) {
            $id = $_REQUEST['id'];

            $lEFOM = new User();
            $lEFO = $lEFOM -> getEquipFO($config['infoLogin'], $config['infoPass'], $id);

            echo json_encode($lEFO);
        }

        if (isset($_REQUEST['listSolS'])) {
            $lSolSM = new User();

            $lSolS = $lSolSM -> getSolS($config['infoLogin'], $config['infoPass']);

            echo json_encode($lSolS);
        }

        if (isset($_REQUEST['listSolSP'])) {
            $lSolSPM = new User();

            $lSolSP = $lSolSPM -> getSolSP($config['infoLogin'], $config['infoPass']);

            echo json_encode($lSolSP);
        }

        if (isset($_REQUEST['getSolFID'])) {
            $id = $_REQUEST['id'];

            $lSolIDM = new User();
            $lSolID = $lSolIDM -> getSolFID($config['infoLogin'], $config['infoPass'], $id);

            echo json_encode($lSolID);
        }

        if (isset($_REQUEST['listFail'])) {
            $lFailM = new User();

            $lFail = $lFailM -> listFA($config['infoLogin'], $config['infoPass']);

            echo json_encode($lFail);
        }

        if (isset($_REQUEST['listFailP'])) {
            $lFailPM = new User();

            $lFailP = $lFailPM -> listFP($config['infoLogin'], $config['infoPass']);

            echo json_encode($lFailP);
        }

        if (isset($_REQUEST['acccanReport'])) {
            $id = $_REQUEST['id'];
            $report = $_REQUEST['report'];
            $st = $_REQUEST['status'];

            $upModel = new User();
            $updateReport = $upModel -> updateSoli($config['infoLogin'], $config['infoPass'], $id, $report, $st);
        }

        if (isset($_REQUEST['accanRpF'])) {
            $id = $_REQUEST['id'];
            $report = $_REQUEST['report'];
            $st = $_REQUEST['status'];

            $upFM = new User();
            $updateRPF = $upFM -> updateFailure($config['infoLogin'], $config['infoPass'], $id, $report, $st);
        }

        if (isset($_REQUEST['assignEquip'])) {
            $id = $_REQUEST['id'];
            $id_office = $_REQUEST['id_office'];
            $office = $_REQUEST['office'];
            $estado = $_REQUEST['estado'];
            $fk_estado = $_REQUEST['id_estado'];

            $assModel = new User();
            $assEquip = $assModel -> assEquipment(
                $config['infoLogin'], $config['infoPass'], $id,
                $id_office, $office, $fk_estado, $estado
            );

            $upEstadoM = new User();
            $upEstado = $upEstadoM -> updateEstadoI(
                $config['infoLogin'], $config['infoPass'], $fk_estado, $id
            );
        }

        if (isset($_REQUEST['pendSS'])) {
            $id = $_REQUEST['id'];
            $state = 'Pendiente SS';

            $pendSM = new User();
            $pendS = $pendSM -> changeState($config['infoLogin'], $config['infoPass'], $id, $state);
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

        if (isset($_REQUEST['lEquipFM'])) {
            $mail = $_SESSION['admin'];

            $eqIM = new User();
            $lequipI = $eqIM -> listEqI($config['dirLogin'], $config['dirPass'], $mail);

            echo json_encode($lequipI);
        }

        if (isset($_REQUEST['purReq'])) {
            $titulo_soli = $_REQUEST['titSol'];
            $desc_soli =  $_REQUEST['descSol'];
            $estado_soli = $_REQUEST['estSol'];
            $fk_tipo =  $_REQUEST['fk_tipo'];

            $mail = $_SESSION['admin'];

            $idModel = new Login();
            $getid = $idModel -> getIdUser($mail);

            $fk_user = $getid[0];

            $nameModel = new User();
            $PR = $nameModel -> PR(
                $config['infoLogin'], $config['infoPass'], $titulo_soli, 
                $desc_soli, $estado_soli, $fk_tipo, $fk_user
            );
        }

        if (isset($_REQUEST['purReq2'])) {
            $titulo_soli = $_REQUEST['titSol'];
            $desc_soli = $_REQUEST['descSol'];
            $estado_soli = $_REQUEST['estSol'];
            $fk_tipo = $_REQUEST['fk_tipo'];
            $fk_sol = $_REQUEST['fk_sol'];

            $mail = $_SESSION['admin'];

            $idModel = new Login();
            $getid = $idModel -> getIdUser($mail);

            $fk_user = $getid[0];

            $nameModel2 = new User();
            $PR3 = $nameModel2 -> PR2(
                $config['infoLogin'], $config['infoPass'], $titulo_soli,
                $desc_soli, $estado_soli, $fk_tipo, $fk_user, $fk_sol
            );
        }

        if (isset($_REQUEST['autoReport'])) {
            $id = $_REQUEST['id'];
            $titulo_soli = $_REQUEST['titSol'];
            $desc_soli =  $_REQUEST['descSol'];
            $estado_soli = $_REQUEST['estSol'];
            $fk_tipo =  $_REQUEST['fk_tipo'];

            $mail = $_SESSION['admin'];

            $idModel = new Login ();
            $getid = $idModel -> getIdUser ($mail);

            $fk_user = $getid[0];

            $aRM = new User();
            $aR = $aRM -> PR2(
                $config['infoLogin'], $config['infoPass'], $titulo_soli, 
                $desc_soli, $estado_soli, $fk_tipo, $fk_user, $id
            );

            $state = 'Pendiente SS';

            $arM2 = new User();
            $ar2 = $arM2 -> changeState($config['infoLogin'], $config['infoPass'], $id, $state);
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
            $mail = $_SESSION['info'];

            $nameModel = new User();

            $getName = $nameModel -> getUserName($mail, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getName);
        }

        if (isset($_REQUEST['getMail'])) {
            $mail = $_SESSION['info'];

            echo json_encode($mail);
        }

        if (isset($_REQUEST['lEquipFM'])) {
            $mail = $_SESSION['info'];

            $eqIM = new User();
            $lequipI = $eqIM -> listEqI($config['infoLogin'], $config['infoPass'], $mail);

            echo json_encode($lequipI);
        }

        if (isset($_REQUEST['purReq'])) {
            $titulo_soli = $_REQUEST['titSol'];
            $desc_soli =  $_REQUEST['descSol'];
            $estado_soli = $_REQUEST['estSol'];
            $fk_tipo =  $_REQUEST['fk_tipo'];

            $mail = $_SESSION['info'];

            $idModel = new Login ();
            $getid = $idModel -> getIdUser ($mail);

            $fk_user = $getid[0];

            $nameModel = new User();
            $PR = $nameModel -> PR(
                $config['infoLogin'], $config['infoPass'], $titulo_soli, 
                $desc_soli, $estado_soli, $fk_tipo, $fk_user
            );
        }

        if (isset($_REQUEST['autoReport'])) {
            $id = $_REQUEST['id'];
            $titulo_soli = $_REQUEST['titSol'];
            $desc_soli =  $_REQUEST['descSol'];
            $estado_soli = $_REQUEST['estSol'];
            $fk_tipo =  $_REQUEST['fk_tipo'];

            $mail = $_SESSION['info'];

            $idModel = new Login ();
            $getid = $idModel -> getIdUser ($mail);

            $fk_user = $getid[0];

            $aRM = new User();
            $aR = $aRM -> PR2(
                $config['infoLogin'], $config['infoPass'], $titulo_soli, 
                $desc_soli, $estado_soli, $fk_tipo, $fk_user, $id
            );

            $state = 'Pendiente SS';

            $arM2 = new User();
            $ar2 = $arM2 -> changeState($config['infoLogin'], $config['infoPass'], $id, $state);
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

        if (isset($_REQUEST['lEquipFM'])) {
            $mail = $_SESSION['subA'];

            $eqIM = new User();
            $lequipI = $eqIM -> listEqI($config['subALogin'], $config['subAPass'], $mail);

            echo json_encode($lequipI);
        }

        if (isset($_REQUEST['lEquipFAO'])) {
            $mail = $_SESSION['subA'];

            $eqFAOM = new User();
            $lEqFAO = $eqFAOM -> listEqFAO($config['subALogin'], $config['subAPass'], $mail);

            echo json_encode($lEqFAO);
        }

        if (isset($_REQUEST['lOffices'])) {
            $lOffM = new User();
            $lOff = $lOffM -> listOfficesFS($config['subALogin'], $config['subAPass']);

            echo json_encode($lOff);
        }

        if (isset($_REQUEST['gRPFS'])) {
            $lPRSM = new User();
            $lPRS = $lPRSM -> getRequestssubA($config['subALogin'], $config['subAPass']);

            echo json_encode($lPRS);
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

        if (isset($_REQUEST['getReqSubB'])) {
            $reqModelB = new User();

            $listReqSUB = $reqModelB -> getRequestssubB($config['subBLogin'], $config['subBPass']);

            echo json_encode($listReqSUB);
        }

        if (isset($_REQUEST['changeSR'])) {
            $id = $_REQUEST['changeSR'];
            $state = $_REQUEST['state'];

            $changeModel = new User();

            $chState = $changeModel -> changeState($config['subBLogin'], $config['subBPass'], $id, $state);
        }

        if (isset($_REQUEST['listEquip'])) {
            $LEQ = new User();
    
            $lequip = $LEQ -> listEQ($config['subBLogin'], $config['subBPass']);

            echo json_encode($lequip);
        }

        if (isset($_REQUEST['listSubBO'])) {
            $lSBM = new User();

            $lOffice = $lSBM -> listSubBO($config['subBLogin'], $config['subBPass']);

            echo json_encode($lOffice);
        } 

        if (isset($_REQUEST['lEquipFM'])) {
            $mail = $_SESSION['subB'];

            $eqIM = new User();
            $lequipI = $eqIM -> listEqI($config['subBLogin'], $config['subBPass'], $mail);

            echo json_encode($lequipI);
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

        if (isset($_REQUEST['getEquipT'])) {
            $typeModel = new User();

            $getT = $typeModel -> getEquipType($config['ofiLogin'], $config['ofiPass']);

            echo json_encode($getT);
        }

        if (isset($_REQUEST['getEquipST'])) {
            $mail = $_SESSION['oficina'];

            $sTypeModel = new User();
            $getST = $sTypeModel ->getEquipSType($config['ofiLogin'], $config['ofiPass'], $mail);

            echo json_encode($getST);
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

        if (isset($_REQUEST['lEquipFM'])) {
            $mail = $_SESSION['oficina'];

            $eqIM = new User();
            $lequipI = $eqIM -> listEqI($config['ofiLogin'], $config['ofiPass'], $mail);

            echo json_encode($lequipI);
        }

        if (isset($_REQUEST['gRFO'])) {
            $mail = $_SESSION['oficina'];

            $lRM = new User();
            $lReqFO = $lRM -> getRequestsFO($config['ofiLogin'], $config['ofiPass'], $mail);

            echo json_encode($lReqFO);
        }

        if (isset($_REQUEST['gRPFO'])) {
            $mail = $_SESSION['oficina'];

            $lRPM = new User();
            $lReqPFO = $lRPM -> getRequestsPFO($config['ofiLogin'], $config['ofiPass'], $mail);

            echo json_encode($lReqPFO);
        }

        if (isset($_REQUEST['gFFO'])) {
            $mail = $_SESSION['oficina'];

            $lFM = new User();
            $lFalFO = $lFM -> getFalloFO($config['ofiLogin'], $config['ofiPass'], $mail);

            echo json_encode($lFalFO);
        }

        if (isset($_REQUEST['gFPFO'])) {
            $mail = $_SESSION['oficina'];

            $lFPM = new User();
            $lFalPFO = $lFPM -> getFalloPFO($config['ofiLogin'], $config['ofiPass'], $mail);

            echo json_encode($lFalPFO);
        }

        if (isset($_REQUEST['iNR'])) {
            $titulo_soli = $_REQUEST['titSol'];
            $desc_soli =  $_REQUEST['descSol'];
            $estado_soli = $_REQUEST['estSol'];
            $fk_tipo =  $_REQUEST['fk_tipo'];

            $mail = $_SESSION['oficina'];

            $idModel = new Login();
            $getid = $idModel -> getIdUser($mail);

            $fk_user = $getid[0];

            $nameModel = new User();
            $PR = $nameModel -> PR(
                $config['ofiLogin'], $config['ofiPass'], $titulo_soli, 
                $desc_soli, $estado_soli, $fk_tipo, $fk_user
            );
        }

        if (isset($_REQUEST['iNF'])) {
            $equip = $_REQUEST['equipFail'];
            $desc = $_REQUEST['descFail'];
            $estado = $_REQUEST['estadoFail'];
            $fk_equip = $_REQUEST['idEquip'];

            $mail = $_SESSION['oficina'];

            $idModel = new Login();
            $getid = $idModel -> getIdUser($mail);

            $fk_user = $getid[0];

            $failModel = new User();
            $insFail = $failModel -> iNF(
                $config['ofiLogin'], $config['ofiPass'],
                $equip, $desc, $estado, $fk_equip, $fk_user
            );
        }

        if (isset($_REQUEST['gEFID'])) {
            $id = $_REQUEST['idEquip'];

            $lEqIM = new User();
            $getEquip = $lEqIM -> listEqFID($config['ofiLogin'], $config['ofiPass'], $id);

            echo json_encode($getEquip);
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

        if (isset($_REQUEST['getReqComp'])) {
            $reqModelC = new User();

            $listReqC = $reqModelC -> getRequestsComp($config['compLogin'], $config['compPass']);

            echo json_encode($listReqC);
        }

        if (isset($_REQUEST['getReqCompA'])) {
            $reqModelComp = new User();
            
            $listReqComA = $reqModelComp -> getRequestsCompA($config['compLogin'], $config['compPass']);

            echo json_encode($listReqComA);
        }

        if (isset($_REQUEST['getReqFID'])) {
            $id = $_REQUEST['id'];

            $reqFIDM = new User();
            $getReqFID = $reqFIDM -> getRequestsFIDComp($config['compLogin'], $config['compPass'], $id);

            echo json_encode($getReqFID);
        }

        if (isset($_REQUEST['getReqA'])) {
            $reqModelA = new User();
            $reqA = $reqModelA -> getRequestsApp($config['compLogin'], $config['compPass']);

            echo json_encode($reqA);
        }

        if (isset($_REQUEST['getUserM'])) {
            $mail = $_REQUEST['mail'];

            $nameMModel = new User();

            $getM = $nameMModel -> getUserMData($mail, $config['infoLogin'], $config['infoPass']);

            echo json_encode($getM);
        }

        if (isset($_REQUEST['changeSR'])) {
            $id = $_REQUEST['changeSR'];
            $state = $_REQUEST['state'];

            $changeModelC = new User();

            $chState = $changeModelC -> changeState($config['compLogin'], $config['compPass'], $id, $state);
        }

        if (isset($_REQUEST['listEquip'])) {
            $LEQ = new User();
    
            $lequip = $LEQ -> listEQ($config['compLogin'], $config['compPass']);

            echo json_encode($lequip);
        }

        if (isset($_REQUEST['lEquipFM'])) {
            $mail = $_SESSION['subB'];

            $eqIM = new User();
            $lequipI = $eqIM -> listEqI($config['compLogin'], $config['compPass'], $mail);

            echo json_encode($lequipI);
        }

        if (isset($_REQUEST['getEquipT'])) {
            $typeModel = new User();

            $getT = $typeModel -> getEquipType($config['compLogin'], $config['compPass']);

            echo json_encode($getT);
        }

        if (isset($_REQUEST['getEquipT2'])) {
            $typeModel2 = new User();

            $getT2 = $typeModel2 -> getEquipType2($config['compLogin'], $config['compPass']);

            echo json_encode($getT2);
        }

        if (isset($_REQUEST['getTypeFID'])) {
            $id = $_REQUEST['id'];

            $getTFM = new User();
            $getTF = $getTFM -> getTypeFID($config['compLogin'], $config['compPass'], $id);

            echo json_encode($getTF);
        }

        if (isset($_REQUEST['getBrand'])) {
            $brandModel = new User();

            $getB = $brandModel -> getBrands($config['compLogin'], $config['compPass']);

            echo json_encode($getB);
        }

        if (isset($_REQUEST['getProv'])) {
            $provModel = new User();

            $getP = $provModel -> getProvs($config['compLogin'], $config['compPass']);

            echo json_encode($getP);
        }

        if (isset($_REQUEST['INE'])) {
            $fecha_compra = $_REQUEST['fecha_compra'];
            $fk_prov = $_REQUEST['fk_prov'];
            $fk_tipo = $_REQUEST['fk_tipo'];
            $prestock = $_REQUEST['prestock'];
            $tipo = $_REQUEST['tipo'];

            $INEModel = new User();
            $newEquip = $INEModel -> INE(
                $config['compLogin'], $config['compPass'], $fecha_compra,
                $tipo, $fk_prov, $fk_tipo, $prestock
            );
        }

        if (isset($_REQUEST['upSoli'])) {
            $request = $_REQUEST['request'];

            $upSM = new User();
            $upStat = $upSM -> upSoli($config['compLogin'], $config['compPass'], $request);
        }

        if (isset($_REQUEST['IE'])) {
            $fecha_adq = $_REQUEST['fecha_adq'];
            $garantia =  $_REQUEST['garantia'];
            $desc_equip = $_REQUEST['desc_equip'];
            $marca_equip = $_REQUEST['marca_equip'];
            $tipo = $_REQUEST['tipo'];
            $fk_tipo = $_REQUEST['fk_tipo'];
            $fk_marca = $_REQUEST['fk_marca'];
            $fk_prov = $_REQUEST['fk_prov'];
        
            $IEModel = new User();
            $newEquip = $IEModel -> IE(
                $config['compLogin'], $config['compPass'],
                $fecha_adq, $garantia, $desc_equip, $marca_equip,
                $tipo, $fk_tipo, $fk_marca, $fk_prov
            );

            echo json_encode($newEquip);

            $inEqM = new User();
            $inEq = $inEqM -> inEquipEstado(
                $config['compLogin'], $config['compPass'],
                2, $newEquip
            );

            $upPrestockM = new User();
            $upPS = $upPrestockM -> upPrestock($config['compLogin'], $config['compPass'], $fk_tipo);
        }

        if (isset($_REQUEST['INP'])) {
            $nom_prov = $_REQUEST['nomProv'];
            $dir_prov = $_REQUEST['dirProv'];
            $tel_prov = $_REQUEST['telProv'];

            $INP = new User();
            $InsertNP = $INP -> INP($config['compLogin'], $config['compPass'], $nom_prov, $dir_prov, $tel_prov);
        }

        if (isset($_REQUEST['INB'])) {
            $nom_brand = $_REQUEST['nomBrand'];

            $INBM = new User();
            $InsertNB = $INBM -> INB($config['compLogin'], $config['compPass'], $nom_brand);
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

        if (isset($_REQUEST['lEquipFM'])) {
            $mail = $_SESSION['subB'];

            $eqIM = new User();
            $lequipI = $eqIM -> listEqI($config['audiLogin'], $config['audiPass'], $mail);

            echo json_encode($lequipI);
        }
    }
     