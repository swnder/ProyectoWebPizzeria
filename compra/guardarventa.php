<?php
    /**
    * @author  Lic. Juan B. Torres B. 
    * @version Mayo de 2016
    */

	echo "GUARDANDO FACTURA DE VENTA...";
	include "conexion.php";
    $conex = conexion();
    //GENERAR IDVENTA
    $sql = "SELECT MAX(idventa) AS idv FROM ventacabecera";
    $resultado = mysqli_query($conex, $sql);
    foreach ($resultado as $fila) {
        $idven = $fila["idv"];
    }
    $idven = $idven + 1;
    
    //RECUPERAR DATOS DEL FORMULARIO
    $nufac = $_POST['numfactura'];
    $idcli = $_POST['idcliente'];
    $topag = str_replace(".", "", $_POST['totalpagar']);
    $fecha = $_POST['fecha'];               //Recuperar la fecha
    $fecha = str_replace("/", "-", $fecha); //Cambiar la barra por el guion
    $fecha = date_create($fecha);           //Se crea un objeto fecha con el formato que acepta la BD
    $fecha = date_format($fecha, 'Y-m-d');  //Cambiar el formato de la fecha

    //GUARDAR EN VENTACABECERA
    $sql = "INSERT INTO ventacabecera (idventa, idcliente, numfactura, fecha, totfactura)
            VALUES ('$idven', '$idcli', '$nufac', '$fecha', '$topag')";
    mysqli_query($conex, $sql);
    
    //RECUPERAR EL DETALLE DE LA FACTURA
    $array = explode(",", $_POST['detalle']);   //Convertir el String a Array. El String contiene el Detalle
    $canti = count($array); //Cantidad de elementos del array
    $artic = $canti / 4;    //Cantidad de filas que contiene el Array. Se divide entre 4, porque se recibe 4 campos por cada detalle
    $pos=0;
    for($i=1; $i<=$artic; $i++){
        //OBTENER EL DETALLE DE CADA ARTICULO
        $idart = $array[$pos];
            $pos = $pos +1 ;
        $canti = $array[$pos];
            $pos = $pos +1 ;
        $preuni = $array[$pos];
            $pos = $pos +1 ;
        $subtot = $array[$pos];
            $pos = $pos +1 ;
        
        //GUARDAR EL REGISTRO EN VENTADETALLE
        $sql = "INSERT INTO ventadetalle (idventa, idarticulo, cantidad, preuni, subtotal)
                VALUES ('$idven', '$idart', '$canti', '$preuni', '$subtot')";
        mysqli_query($conex, $sql);

        //ACTUALIZAR EL STOCK DE CADA ARTICULO
        $sql = "UPDATE articulos SET stock = stock - ".$canti." WHERE idarticulo = ".$idart;
        mysqli_query($conex, $sql);
    }
    header("Location:index.php?exito=1");
?>
