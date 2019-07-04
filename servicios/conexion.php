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
            echo "Error de depuración: ".mysqli_connect_error().PHP_EOL;
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
    //para encriptar  y desencriptar
    function encriptar($cadena){
        //Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
        // $key='abcdef123456()[]{}ghi789';
        // $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
        //Devuelve el string encriptado
        $encrypted = md5($cadena);
        return $encrypted;
    }

    function desencriptar($cadena){
        // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
        $key='abcdef123456()[]{}ghi789';
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        //Devuelve el string desencriptado
        return $decrypted;
    }

?>
