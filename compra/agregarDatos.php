<?php
  require_once "../servicios/conexion.php";
  $conex=conexion();
  $c=$_POST['codigo'];
  $des=$_POST['descripcion'];
  $cant=$_POST['cantidad'];
  $pre=$_POST['precio'];

  $sql="INSERT INTO tempcompra(codigo,descripcion,cantidad, precio) values('$c','$des','$cant', '$pre')";
  echo $resu=mysqli_query($conex,$sql);
  
 ?>
