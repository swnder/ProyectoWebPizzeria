<?php
require_once("conexion.php");
session_start();                    //Iniciamos o Continuamos la sesion
unset($_SESSION["nivelUsuario"]);   //Destruye la variable nivelUsuario
session_destroy();                  //Destruye la informacion de la session actual
session_start();

//recibo los datos
$nombre = $_POST['loginname'];
$contrasena = encriptar($_POST['password']);
// $contrasena = $_POST['password'];

if ($nombre == null || $nombre == "") {
        echo "No está autorizado para acceder al sistema!!...";
}else {
    $conexion = conexion();
    $sql = "SELECT * FROM usuario WHERE usuario ='".$nombre."' AND pass =  '".$contrasena."'";
    $resultado = mysqli_query($conexion, $sql);
    $totRegistros = mysqli_num_rows($resultado);

    if ($totRegistros == 0){
        $_SESSION["usuarioValido"] = "no"; //Usuario o contraseña no valido
    }else{
        foreach ($resultado as $row) {
            $id       = $row['id'];
            $nombre   = $row['usuario'];
            $nivel    = $row['nivel'];
        }
        //Se crea variables de sesion
        $_SESSION["usuarioValido"] = "si"; //Usuario y contraseña valido
        $_SESSION["nombreUsuario"] = $nombre;
        $_SESSION["nivelUsuario"]  = $nivel;
        $_SESSION["idUsuario"]  = $id;
        date_default_timezone_set('America/Asuncion');
        $fecha=date("Y-m-d");
        $hora = date("H:i:s");
        $hoy = $fecha. ' '.$hora;
        $sql="INSERT INTO historial (idusuario, fhconexion) VALUES ('$id','$hoy')";
        $resultado = mysqli_query($conexion, $sql);
        $consulta = "SELECT MAX(idhistorial) AS idhistorial FROM historial WHERE idusuario = '$id' ";
        $res = mysqli_query($conexion, $consulta);
        foreach ($res as $rows) {
            $idHistorial = $rows['idhistorial'];
        }
        $_SESSION["idHistorial"]  = $idHistorial;

    }

    header("Location:../index.php");
}
?>
