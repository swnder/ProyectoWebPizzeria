<?php
     require("conexion.php");
     $conex = conexion();
     $opc = $_POST["accion"];
     if ($opc == "N" or $opc == "M"){
		//Capturar los datos enviados por ajax
		$ruc = $_POST["ruc"];
		$raz = strtoupper($_POST["razon"]);
    $tel = $_POST["telefono"];
		$dir = strtoupper($_POST["direccion"]);
    $em = strtoupper($_POST["email"]);
		$ciu = $_POST["idciudad"];
		if ($opc == "M"){
			$rsm = $_POST["rsm"];
			$id  = $_POST["id"];
		}
	}


     if ($opc == "N"){	//NUEVO
		//VERIFICAR QUE RUC NO EXISTA
		$sql = "SELECT ruc FROM cliente WHERE ruc = '$ruc'";
		$res = mysqli_query($conex, $sql);
		$num_reg = mysqli_num_rows($res);
		if ($num_reg > 0){
			echo 1;
		}else{
               $sql = "INSERT INTO cliente (ruc, nombre, telefono, direccion,email, ciudad) VALUES ('$ruc', '$raz', '$tel', '$dir','$dir', '$ciu')";
			$res = mysqli_query($conex, $sql);
			echo 2;
		}
	}else if ($opc == "M"){	//MODIFICAR
          $grabar = true;
		if ($ruc != $rsm){ //Se modifico el Nº de RUC
			//VERIFICAR QUE RUC NO EXISTA
			$sql = "SELECT ruc FROM cliente WHERE ruc = '$ruc'";
			$resul = mysqli_query($conex, $sql);
			$num_reg = mysqli_num_rows($resul);
			if ($num_reg > 0){
				$grabar = false;
				echo 3;
	       	}
		}
		if ($grabar == true){
			$sql = "UPDATE cliente SET ruc='$ruc', nombre='$raz', telefono='$tel', direccion='$dir',email='$em', ciudad='$ciu' WHERE id='$id'";
			$resul = mysqli_query($conex, $sql);
			echo 4;
		}
	}else if ($opc == "E"){	//ELIMINAR
          $id = $_POST["id"];
          $sql = "DELETE FROM cliente WHERE id='$id'";
		$res = mysqli_query($conex, $sql);
          echo 5;
     }
?>
