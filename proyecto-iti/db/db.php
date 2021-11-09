<?php
    /**
     * This class will be used to connect to the database in the login.
     * Esta clase será usada para conectarse a la base de datos en el login.
     * 
     * @return $sqlCnLogin This is the connection to the database for the login.
     * Esta es la conexión a la base de datos para el login.
     */
    class DBLoginConnect {
        public static function sqlCL() {
            $config = parse_ini_file(__DIR__ . '/../../private/config.ini');
            $sqlCnLogin = new mysqli($config['server'], $config['loginUser'], $config['loginPass'], $config['bdName']);
            $sqlCnLogin -> query('SET NAMES "utf-8"');

            return $sqlCnLogin;
        } 
    }

    /**
     * This class will be used to connect to the database in the website
     * with an specific group, from the current user.
     * Esta clase será usada para conectarse a la base de datos en el
     * sitio web con un grupo específico, del usuario activo.
     * 
     * @return $sqlCnUser This is the connection to the database for the user.
     * Esta es la conexión a la base de datos para el usuario.
     */
    class DBUserConnect {
        public static function sqlCU($user, $password) {
            $host = parse_ini_file(__DIR__ . '/../../private/config.ini');
            $sqlCnUser = new mysqli($host['server'], $user, $password, $host['bdName']);
            $sqlCnUser -> query('SET NAMES "utf-8');

            return $sqlCnUser;
        }
    }