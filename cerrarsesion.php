<?php
	require_once("servicios/conexion.php");
	$conexion = conexion();
	session_start(); 	//Iniciamos o Continuamos la sesion
	$id = $_SESSION["idHistorial"];
	$user= $_SESSION["idUsuario"];

	date_default_timezone_set('America/Asuncion');
    $fecha=date("Y-m-d");
    $hora = date("H:i:s");
    $hoy = $fecha.' '.$hora;
    $sql = "UPDATE historial SET fhdesconexion = '$hoy' WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);
		// cambiar de estado
		$sql = "UPDATE usuario SET estado = 'inactivo' where id='$user'";
    $resultado = mysqli_query($conexion, $sql);

    session_unset();	//Elimina informaciones de todas las sesiones
		session_destroy();	//Cierra la sesion
	header("Location:./index.php");
?>
