<?php
     require("conexion.php");
     $conex = conexion();
     $opc = $_POST["accion"];
     if ($opc == "N" or $opc == "M"){
		//Capturar los datos enviados por ajax
		$nombre = strtoupper($_POST["nombre"]);
          $idcategoria = $_POST["idcategoria"];
          $idmarca = $_POST["idmarca"];
          $precio = $_POST["precio"];
          $idtamano = $_POST["idtamano"];
          $stock = $_POST["stock"];
		if ($opc == "M"){
			$rsm = $_POST["rsm"];
			$id  = $_POST["id"];
		}
	}


     if ($opc == "N"){	//NUEVO
		//VERIFICAR QUE RUC NO EXISTA
		$sql = "SELECT nombre FROM producto WHERE nombre = '$nombre'";
		$res = mysqli_query($conex, $sql);
		$num_reg = mysqli_num_rows($res);
		if ($num_reg > 0){
			echo 1;
		}else{
               $sql = "INSERT INTO producto (nombre,categoria, marca, precio,tamano,stock) VALUES ('$nombre', '$idcategoria', '$idmarca', '$precio', '$idtamano','$stock')";
			$res = mysqli_query($conex, $sql);
			echo 2;
		}
	}else if ($opc == "M"){	//MODIFICAR
          $grabar = true;

		if ($grabar == true){
               $sql = "UPDATE producto SET nombre='$nombre', categoria='$idcategoria', marca='$idmarca', precio='$precio', tamano='$idtamano',stock='$stock' WHERE id='$id'";
			$resul = mysqli_query($conex, $sql);
			echo 4;
		}
	}else if ($opc == "E"){	//ELIMINAR
          $id = $_POST["id"];
          $sql = "DELETE FROM producto WHERE id='$id'";
		$res = mysqli_query($conex, $sql);
          echo 5;
     }
?>
