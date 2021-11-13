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
            private $lSolP = array(),
            private $officS = array(),
            private $officeG = array(),
            private $lReqFO = array(),
            private $reporta_fallo = array(),
            private $rFallo = array(),
            private $lFalloFO = array(),
            private $sTypeData = array(),
            private $equipFID = array(),
            private $lReqPFO = array(),
            private $lFalloPFO = array(),
            private $lEquipFO = array(),
            private $lSolSP = array(),
            private $lSolS = array(),
            private $lSolFID = array(),
            private $lReqCID = array(),
            private $OSData = array(),
            private $equipFAO = array(),
            private $officeFS = array(),
            private $lReqSA = array(),
            private $lReqA = array(),
            private $lTypeFID = array(),
            private $lReqCA = array(),
            private $lTypeS = array(),
            private $depData = array(),
            private $lNext = array(),
            private $lReqBA = array(),
            private $equipFSB = array(),
            private $lReqAud = array(),
            private $typeDataN = array(),
            private $typeDataOff = array(),
            private $equipAu = array()
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

        public function insertNOffice(
            $user, $password, $desc, $grupo, $dir, $dep, $ciudad, $tel, $fk_dep, $fk_grupo
        ) {
            $inNO = "INSERT INTO oficina (
                desc_lugar, grupo_lugar, dir_lugar, depart_lugar,
                ciudad_lugar, tel_lugar, fk_dep, fk_grupo
            ) VALUES (
                '$desc', '$grupo', '$dir', '$dep', '$ciudad',
                '$tel', '$fk_dep', '$fk_grupo'
            );";

            $queryNO = DBUserConnect::sqlCU($user, $password) -> query($inNO);
        }

        public function getEquipType($user, $password) {
            $type = "SELECT * FROM tipo_equipamiento;";

            $queryType = DBUserConnect::sqlCU($user, $password) -> query($type);

            while ($rType = $queryType -> fetch_assoc()) {
                $this -> typeData[] = $rType;
            }

            return $this -> typeData;
        }

        public function getEquipTotal($user, $password) {
            $typeS = "SELECT tipo_equipamiento.*,
            (SELECT COUNT(*) FROM equipamiento 
            WHERE equipamiento.estado_equip = 'Stock'
            AND equipamiento.fk_tipo = tipo_equipamiento.id_tipo) AS stock
            FROM tipo_equipamiento;";

            $queryTS = DBUserConnect::sqlCU($user, $password) -> query($typeS);

            while ($rTS = $queryTS -> fetch_assoc()) {
                $this -> lTypeS[] = $rTS;
            }

            return $this -> lTypeS;
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

        public function getEquipTypeN($user, $password) {
            $typeN = "SELECT * FROM tipo_equipamiento
            WHERE nom_tipo NOT IN ('Computadora', 'Impresora');";

            $queryTypeN = DBUserConnect::sqlCU($user, $password) -> query($typeN);

            while ($rTypeN = $queryTypeN -> fetch_assoc()) {
                $this -> typeDataN[] = $rTypeN;
            }

            return $this -> typeDataN;
        }

        public function getEquipTypeOff($user, $password) {
            $typeOff = "SELECT * FROM tipo_equipamiento
            WHERE nom_tipo IN ('Computadora', 'Impresora');";

            $queryTypeOff = DBUserConnect::sqlCU($user, $password) -> query($typeOff);

            while ($rTypeOff = $queryTypeOff -> fetch_assoc()) {
                $this -> typeDataOff[] = $rTypeOff;
            }

            return $this -> typeDataOff;
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
            $getOData = "SELECT oficina.*, usuario.id_user,
            (SELECT COUNT(*) FROM equipamiento WHERE equipamiento.fk_ofic = oficina.id_lugar) AS eq_inst,
            (SELECT COUNT(*) FROM realiza_soli WHERE realiza_soli.fk_user = usuario.id_user
            AND realiza_soli.estado_soli IN ('Pendiente Info', 'Pendiente SS')) AS sol_pen,
            (SELECT COUNT(*) FROM reporta_fallo WHERE reporta_fallo.fk_user = usuario.id_user
            AND reporta_fallo.estado_fallo = 'Pendiente Info') AS fal_pen
            FROM oficina LEFT JOIN usuario ON usuario.fk_ofic = oficina.id_lugar
            GROUP BY oficina.id_lugar;";

            $queryOData = DBUserConnect::sqlCU($user, $password) -> query($getOData);

            while ($oName = $queryOData -> fetch_assoc()) {
                $this -> OData[] = $oName;
            }

            return $this -> OData;
        }

        public function getDepartData($user, $password) {
            $getDepData = "SELECT * FROM departamento;";

            $queryDep = DBUserConnect::sqlCU($user, $password) -> query($getDepData);

            while ($rDep = $queryDep -> fetch_assoc()) {
                $this -> depData[] = $rDep;
            }

            return $this -> depData;
        }

        public function getOfficeS($user, $password) {
            $getOSData = "SELECT * FROM oficina
            WHERE grupo_lugar = 'Oficina';";

            $queryOSData = DBUserConnect::sqlCU($user, $password) -> query($getOSData);

            while ($rOS = $queryOSData -> fetch_assoc()) {
                $this -> OSData[] = $rOS;
            }

            return $this -> OSData;
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
            $requests = "SELECT *, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli FROM realiza_soli
            WHERE estado_soli = 'Pendiente SubA';";

            $queryReq = DBUserConnect::sqlCU($user, $password) -> query($requests);

            while ($req = $queryReq -> fetch_assoc()) {
                $this -> lReq[] = $req;
            }

            return $this -> lReq;
        }

        public function getRequestssubA($user, $password) {
            $requestsSA = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli,
            oficina.desc_lugar, tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario
            ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento
            ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina
            ON usuario.fk_ofic = oficina.id_lugar
            AND realiza_soli.estado_soli = 'Pendiente SubA';";

            $queryReqSA = DBUserConnect::sqlCU($user, $password) -> query($requestsSA);

            while ($reqSA = $queryReqSA -> fetch_assoc()) {
                $this -> lReqSA[] = $reqSA;
            }

            return $this -> lReqSA;
        }

        public function getRequestssubB($user, $password) {
            $requestSUB = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli, oficina.desc_lugar,
            tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            AND realiza_soli.estado_soli = 'Pendiente SubB'
            ORDER BY realiza_soli.id_soli ASC;";

            $queryReqSUB = DBUserConnect::sqlCU($user, $password) -> query($requestSUB);

            while ($reqB = $queryReqSUB -> fetch_assoc()) {
                $this -> lReqB[] = $reqB;
            }

            return $this -> lReqB;
        }

        public function getRequestssubBA($user, $password) {
            $requestSUBA = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli, oficina.desc_lugar,
            tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            AND realiza_soli.estado_soli IN ('Pendiente SubB', 'Pendiente SD')
            ORDER BY realiza_soli.id_soli ASC;";

            $queryReqSUBA = DBUserConnect::sqlCU($user, $password) -> query($requestSUBA);

            while ($reqBA = $queryReqSUBA -> fetch_assoc()) {
                $this -> lReqBA[] = $reqBA;
            }

            return $this -> lReqBA;
        }

        public function getRequestsComp($user, $password) {
            $requests = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli,
            oficina.desc_lugar, tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            AND realiza_soli.estado_soli = 'Pendiente Compras'
            ORDER BY realiza_soli.id_soli ASC;";

            $queryReqC = DBUserConnect::sqlCU($user, $password) -> query($requests);

            while ($req = $queryReqC -> fetch_assoc()) {
                $this -> lReqC[] = $req;
            }

            return $this -> lReqC;
        }

        public function getRequestsCompA($user, $password) {
            $reqCompA = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli,
            oficina.desc_lugar, tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            AND usuario.grupo_user IN ('Director', 'Informática')
            AND realiza_soli.estado_soli IN ('Pendiente Compras', 'Recibida', 'Aceptada', 'Realizada')
            ORDER BY realiza_soli.id_soli ASC;";

            $queryReqComA = DBUserConnect::sqlCU($user, $password) -> query($reqCompA);

            while ($rreq = $queryReqComA -> fetch_assoc()) {
                $this -> lReqCA[] = $rreq;
            }

            return $this -> lReqCA;
        }

        public function getRequestsAudi($user, $password) {
            $reqFAudi = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli,
            oficina.desc_lugar, tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            AND usuario.grupo_user IN ('Director', 'Informática')
            AND realiza_soli.estado_soli = 'Aceptada'
            ORDER BY realiza_soli.id_soli ASC;";

            $queryReqFAudi = DBUserConnect::sqlCU($user, $password) -> query($reqFAudi);

            while ($rreqAudi = $queryReqFAudi -> fetch_assoc()) {
                $this -> lReqAud[] = $rreqAudi;
            }

            return $this -> lReqAud;
        }

        public function getRequestsFIDComp($user, $password, $id) {
            $requestsID = "SELECT *, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli FROM realiza_soli
            WHERE id_soli = '$id';";

            $queryReqCID = DBUserConnect::sqlCU($user, $password) -> query($requestsID);

            while ($reqID = $queryReqCID -> fetch_assoc()) {
                $this -> lReqCID[] = $reqID;
            }

            return $this -> lReqCID;
        }

        public function getRequestsApp($user, $password) {
            $reqA = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            AND usuario.grupo_user IN ('Director', 'Informática')
            AND realiza_soli.estado_soli = 'Recibida';";

            $queryReqA = DBUserConnect::sqlCU($user, $password) -> query($reqA);

            while ($rowReqA = $queryReqA -> fetch_assoc()) {
                $this -> lReqA[] = $rowReqA;
            }

            return $this -> lReqA;
        }

        public function getTypeFID($user, $password, $id) {
            $typeFID = "SELECT tipo_equipamiento.*, realiza_soli.titulo_soli FROM realiza_soli
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            AND realiza_soli.id_soli = '$id';";

            $queryTFID = DBUserConnect::sqlCU($user, $password) -> query($typeFID);

            while ($rTFID = $queryTFID -> fetch_assoc()) {
                $this -> lTypeFID[] = $rTFID;
            }

            return $this -> lTypeFID;
        }

        public function getRequestsFO($user, $password, $mail) {
            $requests = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli,
            oficina.desc_lugar, tipo_equipamiento.nom_tipo FROM realiza_soli
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
            $requests = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli,
            oficina.desc_lugar, tipo_equipamiento.nom_tipo FROM realiza_soli
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
            $requests = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli, oficina.id_lugar,
            oficina.desc_lugar, tipo_equipamiento.nom_tipo, tipo_equipamiento.prestock,
            (SELECT COUNT(*) FROM equipamiento WHERE estado_equip = 'Stock' AND fk_tipo = realiza_soli.fk_tipo) AS stock,
            (SELECT COUNT(*) FROM equipamiento WHERE equipamiento.fk_ofic = oficina.id_lugar) AS total_equip
            FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            AND realiza_soli.estado_soli IN ('Pendiente Info', 'Pendiente SS', 'Aceptada', 'Rechazada')
            AND usuario.grupo_user = 'Oficina'
            ORDER BY realiza_soli.fecha_ini_soli ASC;";

            $queryReq = DBUserConnect::sqlCU($user, $password) -> query($requests);

            while ($req = $queryReq -> fetch_assoc()) {
                $this -> lSol[] = $req;
            }

            return $this -> lSol;
        }

        public function getSolPInfo($user, $password) {
            $requestsP = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli, oficina.id_lugar, 
            oficina.desc_lugar, tipo_equipamiento.nom_tipo, tipo_equipamiento.prestock,
            (SELECT COUNT(*) FROM equipamiento WHERE estado_equip = 'Stock' AND fk_tipo = realiza_soli.fk_tipo) AS stock,
            (SELECT COUNT(*) FROM equipamiento WHERE equipamiento.fk_ofic = oficina.id_lugar) AS total_equip
            FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            WHERE realiza_soli.estado_soli = 'Pendiente Info'
            AND usuario.grupo_user = 'Oficina'
            ORDER BY realiza_soli.fecha_ini_soli ASC;";

            $queryReqP = DBUserConnect::sqlCU($user, $password) -> query($requestsP);

            while ($reqP = $queryReqP -> fetch_assoc()) {
                $this -> lSolP[] = $reqP;
            }

            return $this -> lSolP;
        }

        public function getSolSP($user, $password) {
            $requestsSP = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli, oficina.desc_lugar,
            tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            AND usuario.grupo_user IN ('Director', 'Informática')
            AND realiza_soli.estado_soli IN ('Pendiente SubB', 'Pendiente Compras', 'Pendiente SD')
            ORDER BY realiza_soli.fecha_ini_soli ASC;";

            $queryReqSP = DBUserConnect::sqlCU($user, $password) -> query($requestsSP);

            while ($reqSP = $queryReqSP -> fetch_assoc()) {
                $this -> lSolSP[] = $reqSP;
            }

            return $this -> lSolSP;
        }

        public function getSolS($user, $password) {
            $requestsS = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli, oficina.desc_lugar,
            tipo_equipamiento.nom_tipo FROM realiza_soli
            INNER JOIN usuario ON realiza_soli.fk_user = usuario.id_user
            INNER JOIN tipo_equipamiento ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            AND usuario.grupo_user IN ('Director', 'Informática')
            AND realiza_soli.estado_soli IN ('Pendiente SubB', 'Pendiente Compras', 'Pendiente SD',
            'Recibida', 'Aceptada', 'Realizada')
            ORDER BY realiza_soli.fecha_ini_soli ASC;";

            $queryReqS = DBUserConnect::sqlCU($user, $password) -> query($requestsS);

            while ($reqS = $queryReqS -> fetch_assoc()) {
                $this -> lSolS[] = $reqS;
            }

            return $this -> lSolS;
        }

        public function getSolFID($user, $password, $id) {
            $lFID = "SELECT realiza_soli.*, DATE_FORMAT(fecha_ini_soli, '%d/%m/%Y') AS fecha_ini_soli,
            DATE_FORMAT(fecha_fin_soli, '%d/%m/%Y') AS fecha_fin_soli,
            tipo_equipamiento.prestock, tipo_equipamiento.nom_tipo,
            (SELECT COUNT(*) FROM equipamiento WHERE estado_equip = 'Stock' AND fk_tipo = realiza_soli.fk_tipo) AS stock
            FROM realiza_soli
            INNER JOIN tipo_equipamiento
            ON realiza_soli.fk_tipo = tipo_equipamiento.id_tipo
            WHERE realiza_soli.id_soli = '$id';";

            $queryFID = DBUserConnect::sqlCU($user, $password) -> query($lFID);

            while ($rFID = $queryFID -> fetch_assoc()) {
                $this -> lSolFID[] = $rFID;
            }

            return $this -> lSolFID;
        }

        public function getEquipFO($user, $password, $id) {
            $equipFO = "SELECT COUNT(*) AS equip_count FROM equipamiento
            INNER JOIN oficina
            ON equipamiento.fk_ofic = oficina.id_lugar
            AND oficina.id_lugar = '$id';";

            $queryEqFO = DBUserConnect::sqlCU($user, $password) -> query($equipFO);

            while ($rEqFO = $queryEqFO -> fetch_assoc()) {
                $this -> lEquipFO[] = $rEqFO;
            }

            return $this -> lEquipFO;
        }

        public function assEquipment($user, $password, $id, $id_office, $office, $id_estado, $estado) {
            $ass = "UPDATE equipamiento SET
            lugar_equip = '$office',
            estado_equip = '$estado',
            fk_estado = '$id_estado',
            fk_ofic = '$id_office'
            WHERE id_equip = '$id';";

            $queryAss = DBUserConnect::sqlCU($user, $password) -> query($ass);
        }

        public function assEquipment2($user, $password, $id) {
            $ass2 = "UPDATE equipamiento SET
            lugar_equip = NULL,
            estado_equip = 'Desguazado',
            fk_estado = 7,
            fk_ofic = NULL
            WHERE id_equip = '$id';";

            $queryAss2 = DBUserConnect::sqlCU($user, $password) -> query($ass2);
        }

        public function assTEquipment($user, $password, $id, $st, $stID) {
            $assT = "UPDATE equipamiento SET
            estado_equip = '$st',
            fk_estado = '$stID'
            WHERE id_equip = '$id';";

            $queryAssT = DBUserConnect::sqlCU($user, $password) -> query($assT);
        }

        public function inEquipEstado($user, $password, $fk_estado, $fk_equip) {
            $inEEstado = "INSERT INTO equip_estado(fecha_inic_estado, fk_estado, fk_equip)
            VALUES (NOW(), '$fk_estado', '$fk_equip');";

            $queryInE = DBUserConnect::sqlCU($user, $password) -> query($inEEstado);
        }

        public function updateEstadoI($user, $password, $fk_estado, $fk_equip, $fk_ofic) {
            $upEstado = "UPDATE equip_estado SET
            fecha_fin_estado = NOW()
            WHERE fecha_fin_estado IS NULL
            AND fk_equip = '$fk_equip';
            
            INSERT INTO equip_estado(fecha_inic_estado, fk_estado, fk_equip)
            VALUES (NOW(), '$fk_estado', '$fk_equip');
            
            INSERT INTO instala_cambia(
                tipo_accion, desc_inst_cambio, fecha_inst_cambio,
                fk_equip, fk_ofic
            ) VALUES (
                'Instalación', '', NOW(), '$fk_equip', '$fk_ofic'  
            )";

            $queryUpEstado = DBUserConnect::sqlCU($user, $password) -> multi_query($upEstado);
        }

        public function updateSoli($user, $password, $id, $report, $st) {
            $update = "UPDATE realiza_soli SET
            reporte_final = '$report',
            estado_soli = '$st',
            fecha_fin_soli = NOW()
            WHERE id_soli = '$id';";

            $updateSol = DBUserConnect::sqlCU($user, $password) -> query($update);
        }

        public function updateFailure($user, $password, $id, $report, $st) {
            $upFail = "UPDATE reporta_fallo SET
            reporte_final = '$report',
            estado_fallo = '$st',
            fecha_fin_fallo = NOW()
            WHERE id_fallo = '$id';";

            $updateFail = DBUserConnect::sqlCU($user, $password) -> query($upFail);
        }

        public function listFP($user, $password) {
            $LFP = "SELECT reporta_fallo.*, DATE_FORMAT(fecha_ini_fallo, '%d/%m/%Y') AS fecha_ini_fallo,
            DATE_FORMAT(fecha_fin_fallo, '%d/%m/%Y') AS fecha_fin_fallo,
            oficina.desc_lugar, equipamiento.desc_equip, equipamiento.marca_equip FROM reporta_fallo
            INNER JOIN usuario ON reporta_fallo.fk_user = usuario.id_user
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            INNER JOIN equipamiento ON reporta_fallo.fk_equip = equipamiento.id_equip
            AND estado_fallo = 'Pendiente Info';";
            $listFP = DBUserConnect::sqlCU($user, $password) -> query($LFP);

            while ($filas = $listFP -> fetch_assoc()){
                $this -> reporta_fallo[] = $filas;
            }

            return $this -> reporta_fallo;
        }

        public function listFA($user, $password) {
            $LFA = "SELECT reporta_fallo.*, DATE_FORMAT(fecha_ini_fallo, '%d/%m/%Y') AS fecha_ini_fallo,
            DATE_FORMAT(fecha_fin_fallo, '%d/%m/%Y') AS fecha_fin_fallo,
            oficina.desc_lugar, equipamiento.desc_equip, equipamiento.marca_equip FROM reporta_fallo
            INNER JOIN usuario ON reporta_fallo.fk_user = usuario.id_user
            INNER JOIN oficina ON usuario.fk_ofic = oficina.id_lugar
            INNER JOIN equipamiento ON reporta_fallo.fk_equip = equipamiento.id_equip;";
            $listFA = DBUserConnect::sqlCU($user, $password) -> query($LFA);

            while ($filas = $listFA -> fetch_assoc()){
                $this -> rFallo[] = $filas;
            }

            return $this -> rFallo;
        }

        public function getFalloFO($user, $password, $mail) {
            $lFFO = "SELECT reporta_fallo.*, DATE_FORMAT(fecha_ini_fallo, '%d/%m/%Y') AS fecha_ini_fallo,
            DATE_FORMAT(fecha_fin_fallo, '%d/%m/%Y') AS fecha_fin_fallo,
            oficina.desc_lugar FROM reporta_fallo
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
            $lPFFO = "SELECT reporta_fallo.*, DATE_FORMAT(fecha_ini_fallo, '%d/%m/%Y') AS fecha_ini_fallo,
            DATE_FORMAT(fecha_fin_fallo, '%d/%m/%Y') AS fecha_fin_fallo,
            oficina.desc_lugar FROM reporta_fallo
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
            LEFT JOIN proveedor ON fk_prov = id_prov
            ORDER BY equipamiento.id_equip ASC;";
            $listEQ = DBUserConnect::sqlCU($user, $password) -> query($LEQ);

            while ($filas = $listEQ -> fetch_assoc()){
                $this -> equipamiento[] = $filas;
            }

            return $this -> equipamiento;
        }

        public function listEQAudi($user, $password) {
            $LEQAu = "SELECT equipamiento.*, DATE_FORMAT(fecha_adq, '%d/%m/%Y') AS fecha_adq,
            proveedor.nom_prov FROM equipamiento
            LEFT JOIN proveedor ON fk_prov = id_prov
            WHERE equipamiento.estado_equip IN ('Stock', 'Instalado')
            ORDER BY equipamiento.id_equip ASC;";

            $queryLEQAu = DBUserConnect::sqlCU($user, $password) -> query($LEQAu);

            while ($rLEQ = $queryLEQAu -> fetch_assoc()) {
                $this -> equipAu[] = $rLEQ;
            }

            return $this -> equipAu;
        }

        public function listEqI($user, $password, $mail_user) {
            $lEquip = "SELECT equipamiento.*, DATE_FORMAT(equipamiento.fecha_adq, '%d/%m/%Y') AS fecha_adq,
            (SELECT COUNT(*) FROM reporta_fallo WHERE estado_fallo = 'Pendiente Info'
            AND reporta_fallo.fk_equip = equipamiento.id_equip) as falla
            FROM equipamiento INNER JOIN usuario ON usuario.fk_ofic = equipamiento.fk_ofic
            AND usuario.mail_user = '$mail_user';";

            $queryEq = DBUserConnect::sqlCU($user, $password) -> query($lEquip);

            while ($filas = $queryEq -> fetch_assoc()){
                $this -> equip[] = $filas;
            }

            return $this -> equip;
        }

        public function listEqFSB($user, $password) {
            $lEqFSB = "SELECT equipamiento.*, DATE_FORMAT(equipamiento.fecha_adq, '%d/%m/%Y') AS fecha_adq
            FROM equipamiento INNER JOIN usuario ON usuario.fk_ofic = equipamiento.fk_ofic
            AND usuario.grupo_user IN ('SubB', 'Compras');";

            $queryEqFSB = DBUserConnect::sqlCU($user, $password) -> query($lEqFSB);

            while ($rEqSB = $queryEqFSB -> fetch_assoc()) {
                $this -> equipFSB[] = $rEqSB;
            }

            return $this -> equipFSB;
        }

        public function listEqFAO($user, $password, $mail_user) {
            $lEquipFAO = "SELECT equipamiento.*, DATE_FORMAT(equipamiento.fecha_adq, '%d/%m/%Y') AS fecha_adq
            FROM equipamiento INNER JOIN usuario ON usuario.fk_ofic = equipamiento.fk_ofic
            WHERE usuario.mail_user = '$mail_user'
            OR usuario.grupo_user = 'Oficina';";

            $queryEquipFAO = DBUserConnect::sqlCU($user, $password) -> query($lEquipFAO);

            while ($rEFAO = $queryEquipFAO -> fetch_assoc()) {
                $this -> equipFAO[] = $rEFAO;
            }

            return $this -> equipFAO;
        }

        public function listEqFID($user, $password, $id) {
            $lEqID = "SELECT *, DATE_FORMAT(fecha_adq, '%d/%m/%Y') AS fecha_adq FROM equipamiento
            WHERE id_equip = '$id';";

            $queryEqID = DBUserConnect::sqlCU($user, $password) -> query($lEqID);

            while ($rEq = $queryEqID -> fetch_assoc()) {
                $this -> equipFID[] = $rEq;
            }

            return $this -> equipFID;
        }

        public function listOfficesFS($user, $password) {
            $lOfficeFS = "SELECT * FROM oficina
            WHERE fk_grupo = 5;";

            $queryOffS = DBUserConnect::sqlCU($user, $password) -> query($lOfficeFS);

            while ($rOFS = $queryOffS -> fetch_assoc()) {
                $this -> officeFS[] = $rOFS;
            }

            return $this -> officeFS;
        }

        public function listSubBO($user, $password) {
            $lOffic = "SELECT * FROM oficina
            WHERE grupo_lugar IN ('SubB', 'Compras');";

            $queryOffic = DBUserConnect::sqlCU($user, $password) -> query($lOffic);

            while ($offrow = $queryOffic -> fetch_assoc()) {
                $this -> officS[] = $offrow;
            }

            return $this -> officS;
        }

        public function listSubBOS($user, $password) {
            $lOfficS = "SELECT * FROM oficina
            WHERE grupo_lugar = 'SubB';";

            $queryOfficS = DBUserConnect::sqlCU($user, $password) -> query($lOfficS);

            while ($offrowS = $queryOfficS -> fetch_assoc()) {
                $this -> officSB[] = $offrowS;
            }

            return $this -> officSB;
        }

        public function INE(
            $user, $password, $fecha_compra, $tipo, $fk_prov, $fk_tipo, $prestock
        ) {
            $qNE = "INSERT INTO provee(
                fecha_compra, tipo_compra, fk_prov, fk_tipo
            ) VALUES (
                DATE '$fecha_compra', '$tipo', '$fk_prov', '$fk_tipo'
            );

            UPDATE tipo_equipamiento
            SET prestock = prestock + '$prestock'
            WHERE id_tipo = '$fk_tipo';";

            $INE = DBUserConnect::sqlCU($user, $password) -> multi_query($qNE);
        }

        public function scrapEquip($user, $password, $idTipo, $nomTipo, $idMarca, $nomMarca) {
            $qScrap = "INSERT INTO equipamiento(
                fecha_adq, garantia, desc_equip, marca_equip, tipo,
                estado_equip, fk_estado, fk_tipo, fk_marca, fk_prov    
            ) VALUES (
                NOW(), 0, '$nomTipo', '$nomMarca', 'Componente',
                'Stock', 2, '$idTipo', '$idMarca', NULL
            );";

            $queryScrap = DBUserConnect::sqlCU($user, $password) -> query($qScrap);
        }

        public function upSoli($user, $password, $request) {
            $upSt = "UPDATE realiza_soli SET
            estado_soli = 'Aceptada',
            fecha_fin_soli = NOW()
            WHERE id_soli = '$request';";

            $queryUpSt = DBUserConnect::sqlCU($user, $password) -> query($upSt);
        }

        public function IE(
            $user, $password, $fecha_adq,
            $garantia, $desc_equip, $marca_equip, $tipo,
            $fk_tipo, $fk_marca, $fk_prov, $fk_estado
        ) {
            $qIE = "INSERT INTO equipamiento(
                fecha_adq, garantia, desc_equip, marca_equip, tipo,
                estado_equip, fk_estado, fk_tipo, fk_marca, fk_prov
            ) VALUES (
                DATE '$fecha_adq', '$garantia', '$desc_equip', '$marca_equip',
                '$tipo', 'Stock', 2, '$fk_tipo', '$fk_marca', '$fk_prov'
            );

            SET @last_id_equip = LAST_INSERT_ID();
            
            INSERT INTO equip_estado(fecha_inic_estado, fk_estado, fk_equip)
            VALUES (NOW(), '$fk_estado', @last_id_equip);";

            $IE = DBUserConnect::sqlCU($user, $password) -> multi_query($qIE);
        }

        public function insertType($user, $password, $nom_tipo) {
            $iType = "INSERT INTO tipo_equipamiento(nom_tipo, prestock)
            VALUES ('$nom_tipo', 0);";

            $queryNType = DBUserConnect::sqlCU($user, $password) -> query($iType);
        }

        public function upPrestock($user, $password, $fk_tipo) {
            $upPrestock = "UPDATE tipo_equipamiento
            SET prestock = prestock - 1
            WHERE id_tipo = '$fk_tipo';";

            $queryPrestock = DBUserConnect::sqlCU($user, $password) -> query($upPrestock);
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

        public function PR2(
            $user, $password, $titulo_soli,
            $desc_soli, $estado_soli,
            $fk_tipo, $fk_user, $fk_soli
        ) {
            $qPR2 = "INSERT INTO realiza_soli(
                titulo_soli, desc_soli, estado_soli,
                fecha_ini_soli, fk_tipo, fk_user, fk_soli
            ) VALUES (
                '$titulo_soli', '$desc_soli', '$estado_soli', 
                NOW(), '$fk_tipo', '$fk_user', '$fk_soli'
            );";

            $PR2 = DBUserConnect::sqlCU($user, $password) -> query($qPR2);
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