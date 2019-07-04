<?php
    /**
    * @author  Lic. Juan B. Torres B.
    * @version Mayo de 2016
    */
    function conexion(){
		$servidor = 'localhost:3306';
		$database = 'webpizzeria';
		$usuario  = 'root';
		$contra   = '123456';
		$conexion = mysqli_connect($servidor, $usuario, $contra, $database);
	    if (!$conexion){
	        echo "Error: No se pudo conectar a MySQL.".PHP_EOL;
	        echo "Error de depuración: ".mysqli_connect_errno().PHP_EOL;
	        echo "Error de depuración: ".mysqli_connect_error().PHP_EOL;
	        exit;
	    }else{
	        $sql = "SET NAMES 'utf8'";
	        $rs = mysqli_query($conexion, $sql);
	    }
	    return $conexion;
    }
?>
