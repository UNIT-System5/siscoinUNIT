<?php 
    class model1 {
        private $dbC;
        private $userData;

        public function __construct() {
            $this -> dbC = dbConnect::sqlC();
            $this -> userData = array();
        }

        public function getUserData() {
            $getData = "SELECT * FROM usuario";
            $queryData = $this -> dbC -> query($getData);

            while($info = $queryData -> fetch_assoc()) {
                $this -> userData[] = $info;
            }

            return $this -> userData;
        }

        public function createUser($code, $group, $mail, $pass, $name, $charge, $fk_group) {
            $create = "INSERT INTO usuario (
                id_user, grupo_user, mail_user, pass_user,
                nom_comp_user, cargo_user, fk_grupo
                )
                VALUES (
                    '$code', '$group', '$mail', '$pass',
                    '$name', '$charge', '$fk_group'
                );";

            $queryCreate = $this -> db -> query($create);
        }
    }
?>