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

            while($info = $queryData -> fetch_assoc()) {
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
    }

    class User {
        private $groupData;

        public function __construct() {
            $this -> groupData = array();
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
            $dbUserConnect = DBUserConnect::sqlCU($user, $password);

            $queryGroup = $dbUserConnect -> query($getGroup);

            while($group = $queryGroup -> fetch_assoc()) {
                $this -> groupData[] = $group;
            }

            return $this -> groupData;
        }

        /**
         * @param createUser This function creates a new user in the database.
         * Esta función crea un nuevo usuario en la base de datos.
         * 
         * @return void
         */
        public function createUser($user, $password, $group, $mail, $pass, $name, $fk_group) {
            $create = "INSERT INTO usuario (
                grupo_user, mail_user, pass_user,
                nom_comp_user, fk_grupo
                )
                VALUES (
                    '$group', '$mail', '$pass',
                    '$name', '$fk_group'
                );";

            $queryCreate = DBUserConnect::sqlCU($user, $password) -> query($create);
        }
    }