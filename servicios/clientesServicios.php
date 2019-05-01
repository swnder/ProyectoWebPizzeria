<?php
     require("conexion.php");
     $conex = conexion();

     $opc = $_POST["accion"];
     if ($opc == "N" or $opc == "M"){
		//Capturar los datos enviados por ajax
		$ruc = $_POST["ruc"];
		$raz = strtoupper($_POST["razon"]);
		$dir = strtoupper($_POST["direccion"]);
		$tel = $_POST["telefono"];
		$mov = $_POST["movil"];
		$tip = $_POST["tipo"];
		if ($opc == "M"){
			$rsm = $_POST["rsm"];
			$id  = $_POST["id"];
		}
	}


     if ($opc == "N"){	//NUEVO
		//VERIFICAR QUE RUC NO EXISTA
		$sql = "SELECT ruc FROM clientes WHERE ruc = '$ruc'";
		$res = mysqli_query($conex, $sql);
		$num_reg = mysqli_num_rows($res);
		if ($num_reg > 0){
			echo 1;
		}else{
               $sql = "INSERT INTO clientes (ruc, razonsocial, direccion, telefono, movil, tipo) VALUES ('$ruc', '$raz', '$dir', '$tel', '$mov', '$tip')";
			$res = mysqli_query($conex, $sql);
			echo 2;
		}
	}else if ($opc == "M"){	//MODIFICAR
          $grabar = true;
		if ($ruc != $rsm){ //Se modifico el Nº de RUC
			//VERIFICAR QUE RUC NO EXISTA
			$sql = "SELECT ruc FROM clientes WHERE ruc = '$ruc'";
			$resul = mysqli_query($conex, $sql);
			$num_reg = mysqli_num_rows($resul);
			if ($num_reg > 0){
				$grabar = false;
				echo 3;
	       	}
		}
		if ($grabar == true){
			$sql = "UPDATE clientes SET ruc='$ruc', razonsocial='$raz', direccion='$dir', telefono='$tel', movil='$mov', tipo='$tip' WHERE idcliente='$id'";
			$resul = mysqli_query($conex, $sql);
			echo 4;
		}
	}else if ($opc == "E"){	//ELIMINAR
          $id = $_POST["id"];
          $sql = "DELETE FROM clientes WHERE idcliente='$id'";
		$res = mysqli_query($conex, $sql);
          echo 5;
     }
?>
