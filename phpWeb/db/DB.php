<?php
    class DB{
        public static function getConexion(){
            $conexion=new mysqli("localhost", "root", "", "anvil");
            $conexion->query("SET NAMES 'utf8'");
            return $conexion;
        }
    }
?>