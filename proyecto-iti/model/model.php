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
        private $groupData;
        private $nameData;
        private $nameSData;
        private $OData;
        private $uwoData;
        private $lReq;
        private $nameMData;

        public function __construct() {
            $this -> groupData = array();
            $this -> nameData = array();
            $this -> nameSData = array();
            $this -> OData = array();
            $this -> uwoData = array();
            $this -> lReq = array();
            $this -> nameMData = array();
        }

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
            $getMData = "SELECT usuario.*, oficina.desc_lugar AS lugar_user FROM usuario
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
            ON usuario.fk_ofic = oficina.id_lugar;";

            $queryUWO = DBUserConnect::sqlCU($user, $password) -> query($getUWO);

            while ($rowUWO = $queryUWO -> fetch_assoc()) {
                $this -> uwoData[] = $rowUWO;
            }

            return $this -> uwoData;
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