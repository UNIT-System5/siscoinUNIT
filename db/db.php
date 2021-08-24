<?php 
    class dbConnect {
        public static function sqlC() {
            $sqlConnection = new mysqli('localhost', 'root', '', 'siscoin_unit');
            $sqlConnection -> query('SET NAMES "utf-8"');

            return $sqlConnection;
        } 
    }
?>