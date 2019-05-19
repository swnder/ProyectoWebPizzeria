<?php
     require_once("conexion.php");
     $conex = conexion();
     $criterio= $_POST["criterio"];
     $valor= $_POST["valor"];
     $busqueda= $_POST["busqueda"];
     $tabla = $_POST["tabla"];
     $sql = "SELECT ".$busqueda." FROM ".$tabla." WHERE ".$criterio." = '$valor'";
     $res = mysqli_query($conex, $sql);
     $reg = mysqli_fetch_array($res);
       echo $reg[$busqueda];

   ?>
