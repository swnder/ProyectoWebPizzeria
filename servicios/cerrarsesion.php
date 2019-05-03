<?php
	session_start(); 	//Iniciamos o Continuamos la sesion
	require_once("servicios/conexion.php");
	$conexion = conexion();
	$id = $_SESSION["idHistorial"];
	date_default_timezone_set('America/Asuncion');
    $fecha=date("Y-m-d");
    $hora = date("H:i:s");
    $hoy = $fecha. ' '.$hora;
    $sql = "UPDATE historial SET fhdesconexion = '$hoy' WHERE idhistorial = '$id'";
    $resultado = mysqli_query($conexion, $sql);
    session_unset();	//Elimina informaciones de todas las sesiones
	session_destroy();	//Cierra la sesion
	header("Location:./index.php");
?>
