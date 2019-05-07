<?php
     require("conexion.php");
     $conex = conexion();

     $opc = $_POST["accion"];
     if ($opc == "N" or $opc == "M"){
		//Capturar los datos enviados por ajax
		$id = $_POST["id"];
		$descri = strtoupper($_POST["descri"]);
		$ubi = strtoupper($_POST["ubi"]);
    $silla = $_POST["sillas"];

		if ($opc == "M"){
			// $rsm = $_POST["rsm"];
			$id  = $_POST["id"];
      $ubi = strtoupper($_POST["ubi"]);
		}
	}


     if ($opc == "N"){	//NUEVO
		//VERIFICAR QUE la ciudad NO EXISTA
		 $sql = "SELECT ubicacion FROM mesa WHERE ubicacion = '$ubi'";
		 $res = mysqli_query($conex, $sql);
		 $num_reg = mysqli_num_rows($res);
		 if ($num_reg > 0){
		 	echo 1;
		 }else{
               $sql = "INSERT INTO mesa (descripcion, ubicacion,sillas) VALUES ('$descri', '$ubi','$silla')";
			$res = mysqli_query($conex, $sql);
			echo 2;
		 }
	 }else if ($opc == "M"){	//MODIFICAR
          $grabar = true;
		// if ($ruc != $rsm){ //Se modifico el Nº de RUC
			//VERIFICAR QUE EL DEPARTAMENTO NO EXISTA
			$sql = "SELECT ubicacion FROM mesa WHERE ubicacion = '$ubi'";
			$resul = mysqli_query($conex, $sql);
			$num_reg = mysqli_num_rows($resul);
			if ($num_reg > 0){
				$grabar = false;
				echo 3;
	       	}
		// }
		if ($grabar == true){
			$sql = "UPDATE mesa SET descripcion ='$descri', ubicacion ='$ubi', sillas='$silla' WHERE id='$id'";
			$resul = mysqli_query($conex, $sql);
			echo 4;
		}
	}else if ($opc == "E"){	//ELIMINAR
          $id = $_POST["id"];
          $sql = "DELETE FROM mesa WHERE id='$id'";
		$res = mysqli_query($conex, $sql);
          echo 5;
     }
?>
