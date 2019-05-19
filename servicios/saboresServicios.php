<?php
     require("conexion.php");
     $conex = conexion();

     $opc = $_POST["accion"];
     if ($opc == "N" or $opc == "M"){
		//Capturar los datos enviados por ajax
		$id = $_POST["id"];
		$sabores = strtoupper($_POST["sabores"]);
		$descripcion= strtoupper($_POST["descripcion"]);


		if ($opc == "M"){
			// $rsm = $_POST["rsm"];
			$id  = $_POST["id"];
      $descripcion = $_POST["descripcion"];
		}
	}


     if ($opc == "N"){	//NUEVO
		//VERIFICAR QUE la ciudad NO EXISTA
		 $sql = "SELECT sabores FROM sabores WHERE sabores= '$sabores'";
		 $res = mysqli_query($conex, $sql);
		 $num_reg = mysqli_num_rows($res);
		 if ($num_reg > 0){
		 	echo 1;
		 }else{
               $sql = "INSERT INTO sabores (sabores, descripcion) VALUES ('$sabores', '$descripcion')";
			$res = mysqli_query($conex, $sql);
			echo 2;
		 }
	 }else if ($opc == "M"){	//MODIFICAR
          $grabar = true;
		// if ($ruc != $rsm){ //Se modifico el Nº de RUC
			//VERIFICAR QUE EL DEPARTAMENTO NO EXISTA
			$sql = "SELECT sabores FROM sabores WHERE id = '$sabores'";
			$resul = mysqli_query($conex, $sql);
			$num_reg = mysqli_num_rows($resul);
			if ($num_reg > 0){
				$grabar = false;
				echo 3;
	       	}
		// }
		if ($grabar == true){
			$sql = "UPDATE sabores SET sabores ='$sabores', descripcion ='$descripcion' WHERE id='$id'";
			$resul = mysqli_query($conex, $sql);
			echo 4;
		}
	}else if ($opc == "E"){	//ELIMINAR
          $id = $_POST["id"];
          $sql = "DELETE FROM sabores WHERE id='$id'";
		$res = mysqli_query($conex, $sql);
          echo 5;
     }
?>
