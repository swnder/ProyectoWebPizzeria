<?php
     require("conexion.php");
     $conex = conexion();
     $opc = $_POST["accion"];
     if ($opc == "N" or $opc == "M"){
		//Capturar los datos enviados por ajax
		$id = $_POST["id"];
		$ciu = strtoupper($_POST["ciudad"]);
		$dep = $_POST["depar"];

		if ($opc == "M"){
			// $rsm = $_POST["rsm"];
			$id  = $_POST["id"];
      $dep = $_POST["depar"];
		}
	}


     if ($opc == "N"){	//NUEVO
		//VERIFICAR QUE la ciudad NO EXISTA
		 $sql = "SELECT ciudad FROM ciudad WHERE ciudad = '$ciu'";
		 $res = mysqli_query($conex, $sql);
		 $num_reg = mysqli_num_rows($res);
		 if ($num_reg > 0){
		 	echo 1;
		 }else{
               $sql = "INSERT INTO ciudad (ciudad, departamento) VALUES ('$ciu', '$dep')";
			$res = mysqli_query($conex, $sql);
			echo 2;
		 }
	 }else if ($opc == "M"){	//MODIFICAR
          $grabar = true;
		// if ($ruc != $rsm){ //Se modifico el Nº de RUC
			//VERIFICAR QUE EL DEPARTAMENTO NO EXISTA
			$sql = "SELECT ciudad FROM ciudad WHERE id = '$ciu'";
			$resul = mysqli_query($conex, $sql);
			$num_reg = mysqli_num_rows($resul);
			if ($num_reg > 0){
				$grabar = false;
				echo 3;
	       	}
		// }
		if ($grabar == true){
			$sql = "UPDATE ciudad SET ciudad ='$ciu', departamento ='$dep' WHERE id='$id'";
			$resul = mysqli_query($conex, $sql);
			echo 4;
		}
	}else if ($opc == "E"){	//ELIMINAR
          $id = $_POST["id"];
          $sql = "DELETE FROM ciudad WHERE id='$id'";
		$res = mysqli_query($conex, $sql);
          echo 5;
     }
?>
