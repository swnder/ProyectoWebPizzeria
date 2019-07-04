<?php
     require("conexion.php");
     $conex = conexion();

     $opc = $_POST["accion"];

          if ($opc == "N" or $opc == "M"){
     		//Capturar los datos enviados por ajax
             $ci = $_POST["ci"];
             $nom = $_POST["nombre"];
             $ape = $_POST["apellido"];
             $fecha = $_POST["fechanaci"];
             $nacio = $_POST["nacionalidad"];
             $telef = $_POST["telef"];
             $bar = $_POST["barrio"];
             $dire = $_POST["direccion"];
             $idciud = $_POST["idciudad"];
             $cargo = $_POST["cargo"];
             $iduser = $_POST["usuario"];

     		if ($opc == "M"){
     			$id  = $_POST["id"];
          $rsm = $_POST["rsm"];
     		}
      }
      if ($opc == "N"){	//NUEVO
     		//VERIFICAR QUE RUC NO EXISTA
     		$sql ="SELECT *  FROM empleado WHERE usuario = '$iduser'";
     		$res = mysqli_query($conex, $sql);
     		$num_reg = mysqli_num_rows($res);
             		if ($num_reg > 0){
             			echo 1;
             		}else{
                  $sql ="SELECT *  FROM empleado WHERE ci='$ci'";
               		$res = mysqli_query($conex, $sql);
               		$num_reg = mysqli_num_rows($res);
                       		if ($num_reg > 0){
                       			echo 2;
                          }else{
                            $sql ="INSERT INTO empleado
                                  (usuario,ci,nombre,apellido,fechanaci,nacionalidad,ciudad,barrio,telefono,cargo,direccion)
                                  VALUES ('$iduser','$ci', '$nom', '$ape', '$fecha', '$nacio','$idciud','$bar', '$telef','$cargo','$dire')";
                       			$res = mysqli_query($conex, $sql);
                       			echo 3;
                            }
             	}
    }else if ($opc == "M"){	//MODIFICAR
               $grabar = true;
     		// if ($ci != $rsm){ //Se modifico el Nº de RUC
     		// 	//VERIFICAR QUE RUC NO EXISTA
     		// 	$sql = "SELECT ci FROM empleado WHERE ci = '$ci'";
     		// 	$resul = mysqli_query($conex, $sql);
     		// 	$num_reg = mysqli_num_rows($resul);
     		// 	if ($num_reg > 0){
     		// 		$grabar = false;
     		// 		echo 4;
     	  //      	}
     		// }
     		if ($grabar == true){
          // no actualiza el CI ni el usuario
     			$sql = "UPDATE empleado SET nombre='$nom', apellido ='$ape', fechanaci='$fecha', nacionalidad='$nacio', ciudad='$idciud', barrio='$bar', telefono='$telef', cargo='$cargo', direccion='$dire' WHERE id='$id'";
     			$resul = mysqli_query($conex, $sql);
     			echo 5;
     		}
     	}else if ($opc == "E"){	//ELIMINAR
               $id = $_POST["id"];
               $sql = "DELETE FROM empleado WHERE id='$id'";
     		$res = mysqli_query($conex, $sql);
               echo 6;
          }





    ?>
