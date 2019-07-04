<?php
		require("conexion.php");
		$conex = conexion();

     //GENERAR IDVENTA
     $sql = "SELECT MAX(nroPedido) As pedido FROM pedido";
     $resultado = mysqli_query($conex, $sql);
     foreach ($resultado as $fila) {
         $nropedido = $fila["pedido"];
     }
    $nropedido = $nropedido + 1;

     //RECUPERAR DATOS DEL FORMULARIO
  		$mesero = $_POST['idmesero'];
     	$idcli = $_POST['idcliente'];
     	$mesa = $_POST['mesa'];
		 	$personas= $_POST['personas'];

			date_default_timezone_set('America/Asuncion');
			$fecha=date("Y-m-d");
			$hora = date("H:i:s");
			$hoy = $fecha. ' '.$hora;
			// $sql = "SELECT mesa FROM pedido where mesa='$mesa'";
			// $res = mysqli_query($conex, $sql);
      // $resultado = mysqli_num_rows($conex, $res);
			// 	foreach ($resultado>0) {
			// 		echo 2;
			// 	}



    // //GUARDAR EN VENTACABECERA
     $sql = "INSERT INTO pedido (nroPedido,fecha,vendedor,cliente,mesa,cantPersona)
             VALUES ('$nropedido','$hoy','$mesero','$idcli','$mesa','$personas')";
     mysqli_query($conex, $sql);

		 // trabajamos con el array

     $sql = "SELECT id As Ide FROM pedido where nroPedido='$nropedido'";
     $resultado = mysqli_query($conex, $sql);
     foreach ($resultado as $fila) {
         $idPedido = $fila["Ide"];
     }

				 //RECUPERAR EL DETALLE DE LA FACTURA
			$array=explode(",", $_POST['detalle']);   //Convertir el String a Array. El String contiene el Detalle
			$canti = count($array); //Cantidad de elementos del array
			$artic = $canti / 2;    //Cantidad de filas que contiene el Array. Se divide entre 4, porque se recibe 4 campos por cada detalle
			$pos=0;
			// echo $_POST['detalle'];
			// echo $artic;
			for($i=1; $i<=$artic; $i++){
					//OBTENER EL DETALLE DE CADA PRODUCTO
						$cant=$array[$pos];
							  $pos = $pos +1 ;
						$pro= $array[$pos];
					     	$pos = $pos +1 ;
								//GUARDAR EL REGISTRO EN PEDIDO
								$sql = "INSERT INTO detallepedido (pedido,producto,cant)
												VALUES ('$idPedido','$pro','$cant')";
								mysqli_query($conex, $sql);
			}
			echo 1;

		 //
		 // if(!empty($_POST["pro"]) && is_array($_POST["pro"])){
		 //
			//  foreach ($_POST["pro"] as $producto) {
			//  		$array=explode(",", $producto);
			//  };
		 //
			//   echo $_POST["pro"].''.;
		 //
			//  $cantid=count($array);
			//  $artic = $cantid / 2;
			//  $pos=0;
			//  for($i=1; $i<=$artic; $i++){
			// 	 	$pro= $array[$pos];
	   //          $pos = $pos +1 ;
			// 		$cant=$array[$pos];
			// 			  $pos = $pos +1 ;
			// 				//GUARDAR EL REGISTRO EN VENTADETALLE
			// 				$sql = "INSERT INTO detallepedido (pedido,producto,cant)
			// 								VALUES ('$idPedido','$pro','$cant')";
			// 				mysqli_query($conex, $sql);
			//  }
		 //
		 // }else{
			//  echo 2;
		 // }



    // header("Location:index.php?exito=1");
?>
