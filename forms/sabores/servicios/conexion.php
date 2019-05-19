<?php
    function conexion(){
        $host     = "localhost";
        $db       = "webpizzeria";
        $usuario  = "root";
        $password = "";
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
