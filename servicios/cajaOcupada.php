<?php
     require("conexion.php");
     session_start();
     $conex = conexion();
     $Caja = $_POST["caja"];
     $numero_caja = $_POST["nro"];
     $estado = $_POST["estado"];
     $monto = $_POST["monto"];

     $sql = "SELECT MAX(Id_caja_detalle) maxi FROM caja_detalle";
     $resul = mysqli_query($conex, $sql);
     $reg = mysqli_fetch_array($resul);
     $max=$reg['maxi'];
     if($max == null){
          $idDetalle = 1;
     }else{
          $idDetalle = $max+1;
     }
     $_SESSION["idDetalle"]=$idDetalle;
     $_SESSION["montoApertura"]=$monto;
     $_SESSION["montoOperaciones"]=$monto;
     date_default_timezone_set ('America/Asuncion');
     $fechaActual = date('Y-m-d H:i:s');

     $ced = $_SESSION["usuario"];
     $cargo = $_SESSION["idCargo"];
     //echo $cargo;
     $sql1 = "INSERT INTO caja_detalle(Id_caja_detalle,Monto_apertura,Fecha_apertura,Cedula,Id_cargo,Caja) VALUES('$idDetalle','$monto','$fechaActual','$ced','$cargo','$Caja')";
     $resul1 = mysqli_query($conex, $sql1);
     $sql2 = "UPDATE cajas SET Estado='$estado' WHERE Caja='$Caja'";
     $resul2 = mysqli_query($conex, $sql2);
     if($estado == "ACTIVO"){
          $_SESSION["caja"]="";
     }else{
          $_SESSION["caja"]=$numero_caja;
     }
     echo 1;
 ?>
