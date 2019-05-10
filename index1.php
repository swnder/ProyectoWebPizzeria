

<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <title>Sistema Pizzeria</title>
          <link rel="icon" href="img/pizzeria.ico"/>
        <?php include "plantilla/dependencias.php"; ?>

 <style media="screen">
.gris{
  background: rgba(19, 154, 117, 0.89);

}
#panelAcceso{
  background: rgba(19, 154, 117, 0.89)!important;
}
</style>

     </head>
     <body style="
        background: url('img/Pizza2.jpg') no-repeat fixed center;
        background-size: cover;">


           <script>
              $(document).ready(function(){
                  var usuValido = "<?php echo isset($_SESSION['usuarioValido']) ? $_SESSION['usuarioValido'] : '0'; ?>";
                  var usuNivel  = "<?php echo isset($_SESSION['nivelUsuario']) ? $_SESSION['nivelUsuario'] : '0'; ?>";
                  if(usuValido == 'no'){
                      alertify.error("Usuario o contraseña incorrecto!!!", "Mensaje del sistema");
                  }else if (usuValido == "si"){
                      if(usuNivel == "ADMINISTRADOR"){
                        <?php session_start(); ?>
                        alertify.warning("Usuario logeado Exitosamente!!!");
                        //redirecciona a la pagina despues del login
                          window.location="./menuAdmin.php";
                      }else{
                        window.location="./AccesoDenegado.php";
                      }
                  }
              });
          </script>
        <div id="panelAcceso" class="card text-center bg-dark">
            <div class="card-header">
              <img class"card-img" id="logo" src="img/pizza.png" alt="logo"/>
                <div class="card-img-overlay">
                  <h3 id="titulo" class="card-title text-white font-weight-bolder">Acceso al Sitio Web</h3>
                </div>
            </div>
                <div class="card-body">
                  <form id="formAcceso" method="post" action="servicios/validarAcceso.php">

                      <!-- usuario -->
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <span class=""><i class="fa fa-user"></i></span>
                            <input class="form-control" id="loginname" name="loginname" type="text" placeholder="Usuario" autofocus>
                          </div>

                      </div>
                      <!-- password -->
                      <div class="row">
                          <div class="col-sm-12 ">
                              <div class="form-group row">
                                  <div class="col-md-12">
                							        <input class="form-control" placeholder="Contraseña" id="password" name="password" type="password" value="" onkeypress="enter(event)">
                                        </div>
                                    </div>
                      <div class="form-group">
                        <button type="button" onclick="validarCampos();"      id="botonIngresar" class="btn btn-lg btn-ligth btn-block">Ingresar</button>
                              </div>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
            <script type="text/javascript">
                  function validarCampos() {
                     if($("#loginname").val()===""){
                          alertify.error("Usuario no puede estar vacio.");
                          $("#loginname").focus();
                      }else if($("#password").val()===""){
                         alertify.error("Contraseña no puede estar vacio.");
                          $("#password").focus();
                      }else{
                          $("#formAcceso").submit();
                      }
                  }

                  function enter(e) {
                        tecla = (document.all) ? e.keyCode : e.which;
                        if (tecla==13){
                            validarCampos();
                        }
                    }
                  </script>

     </body>
</html>
