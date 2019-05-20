<?php


     require("conexion.php");
     $conex = conexion();

      $opc = $_POST["accion"];
      if ($opc == "A" or $opc == "C"){
     		//Capturar los datos enviados por ajax
     		$nrocaja = $_POST["nrocaja"];
     		$monto = $_POST["monto"];
     		$iduser = $_POST["idusuario"];
     		if ($opc == "C"){
     			$id  = $_POST["id"];
 		}
  }
  // obtener la fecha del sistema y hora
    date_default_timezone_set('America/Asuncion');
    $fecha=date("Y-m-d");
    $hora = date("H:i:s");
    $hoy = $fecha. ' '.$hora;

    if ($opc == "A") {
      $sql = "SELECT fechaAper FROM caja WHERE fechaAper like '%$fecha%' AND nro_caja = '$nrocaja'";
  		$res = mysqli_query($conex, $sql);
  		$num_reg = mysqli_num_rows($res);
  		if ($num_reg > 0){
  			echo 1;
  		}else{
        $sql = "SELECT id FROM empleado WHERE usuario = '$iduser'";
    		$res2 = mysqli_query($conex, $sql);
        $encontro= false;
        foreach ($res2 as $rows) {
            $empleado = $rows['id'];
            $encontro= true;
        }
        if($encontro){
          $sql = "INSERT INTO caja (nro_caja, idEmpleAper, fechaAper,Apertura) VALUES ('$nrocaja', '$empleado', '$hoy', '$monto')";
          $res3 = mysqli_query($conex, $sql);
          echo 2;
        }else{
          echo 3;
        }
      }
    }



 ?>
