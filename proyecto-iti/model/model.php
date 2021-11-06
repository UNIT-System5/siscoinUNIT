<?php 
    class Login {
        private $dbCL;
        private $userData;

        public function __construct() {
            $this -> dbCL = DBLoginConnect::sqlCL();
            $this -> userData = array();
            $this -> groupData = array();
        }

        /**
         * @param getUserData This function provides all data from the users.
         * Esta función provee toda la información de los usuarios.
         * 
         * @return array $userData This is an associative array with all the data from the users.
         * $userData Es un array asociativo con toda la información de los usuarios.
         */
        public function getUserData() {
            $getData = "SELECT * FROM usuario;";
            $queryData = $this -> dbCL -> query($getData);

            while ($info = $queryData -> fetch_assoc()) {
                $this -> userData[] = $info;
            }

            return $this -> userData;
        }

        /**
         * @param checkUser This function provides the encrypted password and the group
         * from the user to check if the user exists and if his password matches.
         * Esta función provee la contraseña encriptada y el grupo del usuario para
         * chequear si el usuario existe y si su contraseña coincide.
         * 
         * @return array $check This is a numerical array with the group and the password
         * from the user specified.
         * $check Es un array numérico con el grupo y la contraseña del usuario especificado.
         */
        public function checkUser($mail) {
            $checkData = "SELECT grupo_user, pass_user FROM usuario 
            WHERE mail_user = '$mail';";
            $queryCheck = $this -> dbCL -> query($checkData);

            $check = $queryCheck -> fetch_row();

            if (!$queryCheck) {
                die();
            } else {
                return $check;
            }
        }

        public function getIdUser($mail) {
            $checkID = "SELECT id_user FROM usuario
            WHERE mail_user = '$mail';";

            $queryID = $this -> dbCL -> query($checkID);

            $id = $queryID -> fetch_row();

            return $id;
        }
    }

    class User {
        public function __construct(
            private $groupData = array(),
            private $nameData = array(),
            private $nameSData = array(),
            private $OData = array(),
            private $uwoData = array(),
            private $lReq = array(),
            private $lReqB = array(),
            private $lReqC = array(),
            private $nameMData = array(),
            private $typeData = array(),
            private $equipamiento = array(),
            private $equip = array(),
            private $brandData = array(),
            private $provData = array(),
            private $typeData2 = array(),
            private $lSol = array(),
            private $officS = array(),
            private $officeG = array(),
            private $lReqFO = array(),
            private $reporta_fallo = array(),
            private $rFallo = array(),
            private $lFalloFO = array(),
            private $sTypeData = array(),
            private $equipFID = array(),
            private $lReqPFO = array(),
            private $lFalloPFO = array()
        ) {}

        /**
         * @param getGroupData This function provides all the groups available to list
         * in a select in the website.
         * Esta función provee todos los grupos disponibles para listarlos en un select
         * en la página web.
         * 
         * @return array $groupData This is an associative array with all the groups listed
         * with the id of the group and his name.
         * Este es un array asociativo con un listado de todos los grupos con su respectiva id
         * y nombre.
         */
        public function getGroupData($user, $password) {
            $getGroup = "SELECT * FROM grupo;";

            $queryGroup = DBUserConnect::sqlCU($user, $password) -> query($getGroup);

            while ($group = $queryGroup -> fetch_assoc()) {
                $this -> groupData[] = $group;
            }

            return $this -> groupData;
        }

        public function getUserName($mail, $user, $password) {
            $getName = "SELECT nom_comp_user, pic_user FROM usuario
            WHERE mail_user = '$mail';";
            
            $queryName = DBUserConnect::sqlCU($user, $password) -> query($getName);

            while ($name = $queryName -> fetch_assoc()) {
                $this -> nameData[] = $name;
            }

            return $this -> nameData;
        }

        public function getUserSData($id, $user, $password) {
            $getSData = "SELECT * FROM usuario
            WHERE id_user = '$id';";

            $querySData = DBUserConnect::sqlCU($user, $password) -> query($getSData);

            while ($sName = $querySData -> fetch_assoc()) {
                $this -> nameSData[] = $sName;
            }

            return $this -> nameSData;
        }

        public function getUserMData($mail, $user, $password) {
            $getMData = "SELECT usuario.*, oficina.desc_lugar AS lugar_user, oficina.id_lugar FROM usuario
            INNER JOIN oficina
            ON usuario.fk_ofic = oficina.id_lugar
            AND usuario.mail_user = '$mail';";

            $queryMData = DBUserConnect::sqlCU($user, $password) -> query($getMData);

            while ($mName = $queryMData -> fetch_assoc()) {
                $this -> nameMData[] = $mName;
            }

            return $this -> nameMData;
        }

        public function getUserWOffice($user, $password) {
            $getUWO = "SELECT usuario.*, oficina.desc_lugar FROM usuario
            INNER JOIN oficina
            ON usuario.fk_ofic = oficina.id_lugar
            ORDER BY usuario.id_user ASC;";

            $queryUWO = DBUserConnect::sqlCU($user, $password) -> query($getUWO);

            while ($rowUWO = $queryUWO -> fetch_assoc()) {
                $this -> uwoData[] = $rowUWO;
            }

            return $this -> uwoData;
        }

        public function getOfficeFG($user, $password,  $id) {
            $getOG = "SELECT * FROM oficina
            INNER JOIN usuario
            ON oficina.fk_grupo = usuario.fk_grupo
            AND usuario.id_user = '$id';";

            $queryOG = DBUserConnect::sqlCU($user, $password) -> query($getOG);

            while ($rOG = $queryOG -> fetch_assoc()) {
                $this -> officeG[] = $rOG;
            }

            return $this -> officeG;
        }

        public function getEquipType($user, $password) {
            $type = "SELECT * FROM tipo_equipamiento;";

            $queryType = DBUserConnect::sqlCU($user, $password) -> query($type);

            while ($rType = $queryType -> fetch_assoc()) {
                $this -> typeData[] = $rType;
            }

            return $this -> typeData;
        }

        public function getEquipSType($user, $password, $mail) {
            $sType = "SELECT tipo_equipamiento.* FROM tipo_equipamiento
            INNER JOIN usuario
            INNER JOIN oficina
            ON usuario.fk_ofic = oficina.id_lugar
            INNER JOIN equipamiento
            ON oficina.id_lugar = equipamiento.fk_ofic
            AND equipamiento.fk_tipo = tipo_equipamiento.id_tipo
            AND usuario.mail_user = '$mail';";

            $queryS = DBUserConnect::sqlCU($user, $password) -> query($sType);

            while ($rS = $queryS -> fetch_assoc()) {
                $this -> sTypeData[] = $rS;
            }

            return $this -> sTypeData;
        }

        public function getEquipType2($user, $password) {
            $type = "SELECT * FROM tipo_equipamiento
            WHERE prestock > 0;";

            $queryType = DBUserConnect::sqlCU($user, $password) -> query($type);

            while ($rType = $queryType -> fetch_assoc()) {
                $this -> typeData2[] = $rType;
            }

            return $this -> typeData2;
        }

        public function getBrands($user, $password) {
            $brand = "SELECT * FROM marca;";

            $queryBrand = DBUserConnect::sqlCU($user, $password) -> query($brand);

            while ($rBrand = $queryBrand -> fetch_assoc()) {
                $this -> brandData[] = $rBrand;
            }

            return $this -> brandData;
        }

        public function getProvs($user, $password) {
            $prov = "SELECT * FROM proveedor;";

            $queryProv = DBUserConnect::sqlCU($user, $password) -> query($prov);

            while ($rProv = $queryProv -> fetch_assoc()) {
                $this -> provData[] = $rProv;
            }

            return $this -> provData;
        }

        public function getOfficeData($user, $password) {
            $getOData = "SELECT * FROM oficina;";

            $queryOData = DBUserConnect::sqlCU($user, $password) -> query($getOData);

            while ($oName = $queryOData -> fetch_assoc()) {
                $this -> OData[] = $oName;
            }

            return $this -> OData;
        }

        /**
         * @param createUser This function creates a new user in the database.
         * Esta función crea un nuevo usuario en la base de datos.
         * 
         * @return void
         */
        public function createUser($user, $password, $group, $mail, $pass, $name, $fk_ofic, $fk_group) {
            $create = "INSERT INTO usuario (
                grupo_user, mail_user, pass_user,
                nom_comp_user, fk_ofic, fk_grupo
                )
                VALUES (
                    '$group', '$mail', '$pass',
                    '$name', '$fk_ofic', '$fk_group'
                );";

            $queryCreate = DBUserConnect::sqlCU($user, $password) -> query($create);
        }

        public function modUser($user, $password, $id, $name, $mail, $group, $fk_ofic, $fk_group) {
            $mod = "UPDATE usuario SET
            nom_comp_user = '$name', mail_user = '$mail',
            grupo_user = '$group', fk_ofic = '$fk_ofic',
            fk_grupo = '$fk_group'
            WHERE id_user = '$id';";

            $queryMod = DBUserConnect::sqlCU($user, $password) -> query($mod);
        }

        public function deleteUser($user, $password, $code) {
            $delete = "DELETE FROM usuario WHERE id_user = '$code';";

            $queryCreate = DBUserConnect::sqlCU($user, $password) -> query($delete);
        }

        public function getRequests($user, $password) {
            $requests = "SELECT * FROM realiza_soli
            WHERE estado_soli = 'Pendiente SubA';";

            $queryReq = DBUserConnect::sqlCU($user, $password) -> query($requests);

            while ($req = $queryReq -> fetch_assoc()) {
                $this -> lReq[] = $req;
            }

            return $this -> lReq;
        }

        public function getRequestssubB($user, $password) {
            $requestSUB = "SELECT * FROM realiza_soli
            WHERE estado_soli = 'Pendiente SubB'
            ORDER BY id_soli DESC;";

            $queryReqSUB = DBUserConnect::sqlCU($user, $password) -> query($requestSUB);

            while ($reqB = $queryReqSUB -> fetch_assoc()) {
                $this -> lReqB[] = $reqB;
            }

            return $this -> lReqB;
        }

        public function getRequestsComp($user, $password) {
            $requests = "SELECT * FROM realiza_soli
            WHERE estado_soli = 'Pendiente Compras';";

            $queryReqC = DBUserConnect::sqlCU($user, $password) -> query($requests);

            while ($req = $queryReqC -> fetch_assoc()) {
                $this -> lReqC[] = $req;
            }

            return $this -> lReqC;
        }

        public function getRequestsFO($user, $password, $mail) {
            $requests = "SELECT realiza_soli.*, oficina.desc_lugar, tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario
            ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento
            ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina
            ON usuario.fk_ofic = oficina.id_lugar
            AND usuario.mail_user = '$mail';";

            $queryRecFO = DBUserConnect::sqlCU($user, $password) -> query($requests);

            while ($rowReq = $queryRecFO -> fetch_assoc()) {
                $this -> lReqFO[] = $rowReq;
            }

            return $this -> lReqFO;
        }

        public function getRequestsPFO($user, $password, $mail) {
            $requests = "SELECT realiza_soli.*, oficina.desc_lugar, tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario
            ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento
            ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina
            ON usuario.fk_ofic = oficina.id_lugar
            AND usuario.mail_user = '$mail'
            AND realiza_soli.estado_soli REGEXP '^Pendiente';";

            $queryRecPFO = DBUserConnect::sqlCU($user, $password) -> query($requests);

            while ($rowReqP = $queryRecPFO -> fetch_assoc()) {
                $this -> lReqPFO[] = $rowReqP;
            }

            return $this -> lReqPFO;
        }

        public function getSolInfo($user, $password) {
            $requests = "SELECT realiza_soli.*, oficina.desc_lugar, tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario
            ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento
            ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina
            ON usuario.fk_ofic = oficina.id_lugar;";

            $queryReq = DBUserConnect::sqlCU($user, $password) -> query($requests);

            while ($req = $queryReq -> fetch_assoc()) {
                $this -> lSol[] = $req;
            }

            return $this -> lSol;
        }

        public function listFP($user, $password) {
            $LFP = "SELECT * FROM reporta_fallo
            WHERE estado_fallo REGEXP '^Pendiente';";
            $listFP = DBUserConnect::sqlCU($user, $password) -> query($LFP);

            while ($filas = $listFP -> fetch_assoc()){
                $this -> reporta_fallo[] = $filas;
            }

            return $this -> reporta_fallo;
        }

        public function listFA($user, $password) {
            $LFA = "SELECT * FROM reporta_fallo;";
            $listFA = DBUserConnect::sqlCU($user, $password) -> query($LFA);

            while ($filas = $listFA -> fetch_assoc()){
                $this -> rFallo[] = $filas;
            }

            return $this -> rFallo;
        }

        public function getFalloFO($user, $password, $mail) {
            $lFFO = "SELECT reporta_fallo.*, oficina.desc_lugar FROM reporta_fallo
            INNER JOIN usuario
            ON reporta_fallo.fk_user = usuario.id_user
            INNER JOIN oficina
            ON usuario.fk_ofic = oficina.id_lugar
            AND usuario.mail_user = '$mail';";
            $queryFFO = DBUserConnect::sqlCU($user, $password) -> query($lFFO);

            while ($rowFFO = $queryFFO -> fetch_assoc()) {
                $this -> lFalloFO[] = $rowFFO;
            }

            return $this -> lFalloFO;
        }

        public function getFalloPFO($user, $password, $mail) {
            $lPFFO = "SELECT reporta_fallo.*, oficina.desc_lugar FROM reporta_fallo
            INNER JOIN usuario
            ON reporta_fallo.fk_user = usuario.id_user
            INNER JOIN oficina
            ON usuario.fk_ofic = oficina.id_lugar
            AND usuario.mail_user = '$mail'
            AND estado_fallo REGEXP '^Pendiente';";
            $queryPFFO = DBUserConnect::sqlCU($user, $password) -> query($lPFFO);

            while ($rowPFFO = $queryPFFO -> fetch_assoc()) {
                $this -> lFalloPFO[] = $rowPFFO;
            }

            return $this -> lFalloPFO;
        }

        public function listEQ($user, $password) {
            $LEQ = "SELECT equipamiento.*, DATE_FORMAT(fecha_adq, '%d/%m/%Y') AS fecha_adq,
            proveedor.nom_prov FROM equipamiento
            INNER JOIN proveedor ON fk_prov = id_prov
            ORDER BY equipamiento.id_equip ASC;";
            $listEQ = DBUserConnect::sqlCU($user, $password) -> query($LEQ);

            while($filas = $listEQ -> fetch_assoc()){
                $this -> equipamiento[] = $filas;
            }

            return $this -> equipamiento;
        }

        public function listEqI($user, $password, $mail_user) {
            $lEquip = "SELECT equipamiento.*, DATE_FORMAT(equipamiento.fecha_adq, '%d/%m/%Y') AS fecha_adq
            FROM equipamiento INNER JOIN usuario ON usuario.fk_ofic = equipamiento.fk_ofic
            AND usuario.mail_user = '$mail_user';";
            $queryEq = DBUserConnect::sqlCU($user, $password) -> query($lEquip);

            while ($filas = $queryEq -> fetch_assoc()){
                $this -> equip[] = $filas;
            }

            return $this -> equip;
        }

        public function listEqFID($user, $password, $id) {
            $lEqID = "SELECT * FROM equipamiento
            WHERE id_equip = '$id';";

            $queryEqID = DBUserConnect::sqlCU($user, $password) -> query($lEqID);

            while ($rEq = $queryEqID -> fetch_assoc()) {
                $this -> equipFID[] = $rEq;
            }

            return $this -> equipFID;
        }

        public function listSubBO($user, $password) {
            $lOffic = "SELECT * FROM oficina
            WHERE grupo_lugar = 'SubB'
            OR grupo_lugar = 'Compras';";

            $queryOffic = DBUserConnect::sqlCU($user, $password) -> query($lOffic);

            while ($offrow = $queryOffic -> fetch_assoc()) {
                $this -> officS[] = $offrow;
            }

            return $this -> officS;
        }

        public function INE($user, $password, $fecha_compra, $tipo_compra, $fk_prov, $fk_tipo, $prestock) {
            $qNE = "INSERT INTO provee(
                fecha_compra, tipo_compra, fk_prov, fk_tipo
            ) VALUES (
                DATE '$fecha_compra', '$tipo_compra', '$fk_prov', '$fk_tipo'
            );
            UPDATE tipo_equipamiento
            SET prestock = prestock + '$prestock'
            WHERE id_tipo = '$fk_tipo';"; 

            $INE = DBUserConnect::sqlCU($user, $password) -> multi_query($qNE);
        }

        public function IE(
            $user, $password, $fecha_adq,
            $garantia, $desc_equip, $marca_equip, $tipo,
            $fk_tipo, $fk_marca, $fk_prov
        ) {
            $qIE = "INSERT INTO equipamiento(
                fecha_adq, garantia, desc_equip, marca_equip, tipo,
                estado_equip, fk_estado, fk_tipo, fk_marca, fk_prov
            ) VALUES (
                DATE '$fecha_adq', '$garantia', '$desc_equip', '$marca_equip',
                '$tipo', 'Stock', 2, '$fk_tipo', '$fk_marca', '$fk_prov'
            );
            UPDATE tipo_equipamiento
            SET prestock = prestock - 1
            WHERE id_tipo = '$fk_tipo';"; 

            $IE = DBUserConnect::sqlCU($user, $password) -> multi_query($qIE);
        }

        public function INP($user, $password, $nom_prov, $dir_prov, $tel_prov){
            $qNP = "INSERT INTO proveedor(
                    nom_prov, dir_prov, tel_prov
                ) VALUES (
                    '$nom_prov', '$dir_prov', '$tel_prov'
                );";

            $INP = DBUserConnect::sqlCU($user, $password) -> query($qNP);
        }

        public function INB($user, $password, $nom_brand){
            $qNB = "INSERT INTO marca(nom_marca)
                VALUES (
                    '$nom_brand'
                );";

            $INB = DBUserConnect::sqlCU($user, $password) -> query($qNB);
        }

        public function PR(
            $user, $password, $titulo_soli,
            $desc_soli, $estado_soli,
            $fk_tipo, $fk_user
        ) {
            $qPR = "INSERT INTO realiza_soli(
                titulo_soli, desc_soli, estado_soli,
                fecha_ini_soli, fk_tipo, fk_user
            ) VALUES (
                '$titulo_soli', '$desc_soli', '$estado_soli', 
                NOW(), '$fk_tipo', '$fk_user'
            );";

            $PR = DBUserConnect::sqlCU($user, $password) -> query($qPR);
        }

        public function iNF(
            $user, $password, $equip, $desc,
            $estado, $fk_equip, $fk_user
        ) {
            $inFail = "INSERT INTO reporta_fallo(
                equip_fallo, desc_fallo, estado_fallo,
                fecha_ini_fallo, fk_equip, fk_user
            ) VALUES (
                '$equip', '$desc', '$estado',
                NOW(), '$fk_equip', '$fk_user'
            );";

            $queryFail = DBUserConnect::sqlCU($user, $password) -> query($inFail);
        }

        public function changeState($user, $password, $id, $state) {
            $chState = "UPDATE realiza_soli SET
            estado_soli = '$state'
            WHERE id_soli = '$id';";

            $queryState = DBUserConnect::sqlCU($user, $password) -> query($chState);
        }

        public function setPPic($user, $password, $id, $path) {
            $setPic = "UPDATE usuario SET
            pic_user = '$path'
            WHERE id_user = '$id';";

            $queryPic = DBUserConnect::sqlCU($user, $password) -> query($setPic);
        }
    }