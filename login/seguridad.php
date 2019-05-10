<?php
  // clase encargada del control de la seguridad de la paginate
  class seguridad{
    private $usuario=null;
    function _contruct(argument){
      // arrancamos la sesion
      session_start();
      // mientras se crea el constructor
      // se inicia la session para luego almacenarlos en usuario si es que existe 
      if(isset($_session["usuario"])) $this->$usuario=$_session["usuario"];
    }
    public getusuario(){
      return $usuario;
    }
  }
 ?>
