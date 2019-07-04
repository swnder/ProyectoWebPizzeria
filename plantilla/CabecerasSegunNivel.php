<?php
  session_start();
  $usuValido= isset($_SESSION['usuarioValido']) ? $_SESSION['usuarioValido'] : '0';
  $usuNivel=isset($_SESSION['nivelUsuario']) ? $_SESSION['nivelUsuario'] : '0';
  echo $usuValido;

  if($usuValido=='no'){
    header('Location:../index.php');
  }else if($usuValido=='si'){
    if($usuNivel == 'ADMINISTRADOR'){
      require_once "cabecera.php";
    }else if($usuNivel == 'CAJERO'){
      require_once "cabeceraCajero.php";
    }else if ($usuNivel=='CONTABILIDAD') {
      require_once "cabeceraConta.php";
    }
  }else if ($usuNivel== '0'){
    header('Location:./index.php');
  }



?>
