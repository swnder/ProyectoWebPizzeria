<?php
    function conexion(){
        $host     = "localhost";
        $db       = "dbclientes";
        $usuario  = "root";
        $password = "123456";
        $conexion = null;

        $conexion = mysqli_connect($host, $usuario, $password, $db);

        if (!$conexion){
            echo "Error: No se pudo conectar a MySQL.".PHP_EOL;
            exit;
        }else{
            $sql = "SET NAMES 'utf8'";
            $resultado = mysqli_query($conexion, $sql);
        }
        return $conexion;
    }

    function cerrarBD($conexion){
        $conexion = null;
    }
?>
