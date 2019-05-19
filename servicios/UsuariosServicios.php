<?php
     require("conexion.php");
     $conex = conexion();

     $opc = $_POST["accion"];
     if ($opc == "N" or $opc == "M"){
		//Capturar los datos enviados por ajax
      		$id = $_POST["id"];
      		$user = $_POST["usuario"];
      		$nivel = strtoupper($_POST["nivel"]);
          $pass = MD5($_POST["pass"]);

		if ($opc == "M"){
			// $rsm = $_POST["rsm"];
			$id  = $_POST["id"];

		}
	}


     if ($opc == "N"){	//NUEVO
		//VERIFICAR QUE el usuario NO EXISTA
		 $sql = "SELECT usuario FROM usuario WHERE usuario = '$user'";
		 $res = mysqli_query($conex, $sql);
		 $num_reg = mysqli_num_rows($res);
		 if ($num_reg > 0){
		 	echo 1;
		 }else{
               $sql = "INSERT INTO usuario (usuario, pass,nivel) VALUES ('$user', '$pass','$nivel')";
			$res = mysqli_query($conex, $sql);
			echo 2;
		 }
	 }else if ($opc == "M"){	//MODIFICAR
          $grabar = true;
		// if ($ruc != $rsm){ //Se modifico el Nº de RUC
			//VERIFICAR QUE EL DEPARTAMENTO NO EXISTA
			// $sql = "SELECT usuario FROM usuario WHERE usuario = '$user'";
			// $resul = mysqli_query($conex, $sql);
			// $num_reg = mysqli_num_rows($resul);
			// if ($num_reg > 0){
			// 	$grabar = false;
			// 	echo 3;
	    //    	}
		// }
		if ($grabar == true){
			$sql = "UPDATE usuario SET usuario ='$user', pass ='$pass', nivel='$nivel' WHERE id='$id'";
			$resul = mysqli_query($conex, $sql);
			echo 4;
		}
	}else if ($opc == "E"){	//ELIMINAR
          $id = $_POST["id"];

          $sql = "DELETE FROM usuario WHERE id= '$id'";
		      $res = mysqli_query($conex, $sql);
          // CONSULTA PARA VERIFICAR QUE BORRA EL ID
          $sql = "SELECT * FROM usuario WHERE id='$id'";
		      $res = mysqli_query($conex, $sql);
          $num_reg = mysqli_num_rows($res);
          if ($num_reg > 0){
            echo $id;
          }else{

            echo 5;
          }

     }
?>
