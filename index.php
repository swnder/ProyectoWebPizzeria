<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <title>Sistema Pizzeria</title>
          <link rel="icon" href="img/pizzeria.ico"/>
          <link rel="stylesheet" href="/css/master.css">
          <!-- CSS REQUERIDOS -->
          <link rel="stylesheet" href="css/misestilos1.css">
          <link rel="stylesheet" href="css/toastr.css">
          <link rel="stylesheet" href="alertify/alertify.min.css">
          <!-- Bootstrap -->
          <link rel="stylesheet" href="bt/bootstrap.min.css">
          <!-- JS REQUERIDOS -->
          <!-- JQuery -->
          <script src="js/jquery-3.3.1.min.js"></script>
          <script src="js/bootstrap.js"></script>
          <script src="js/toastr.js"></script>
          <script src="alertify/alertify.min.js">

          </script>
          <!-- Boostrap -->
          <script src="bt/bootstrap.min.js"></script>

     </head>
     <body style="
        background: url('img/fondoAlienPizza.jpg') no-repeat fixed center;
        background-size: cover;
        font-family: 'Roboto',Sans-Serif;">

          <?php session_start(); ?>
          <script>
              $(document).ready(function(){
                  var usuValido = "<?php echo isset($_SESSION['usuarioValido']) ? $_SESSION['usuarioValido'] : '0'; ?>";
                  var usuNivel  = "<?php echo isset($_SESSION['nivelUsuario']) ? $_SESSION['nivelUsuario'] : '0'; ?>";
                  if(usuValido == 'no'){
                      alertify.error("Usuario o contraseña incorrecto!!!", "Mensaje del sistema");
                  }else if (usuValido == "si"){
                      if(usuNivel == "Administrador"){
                        //redirecciona a la pagina despues del login
                          window.location="prueba.html";
                      }
                  }
              });
          </script>
        <div id="panelAcceso" class="card text-center bg-dark">
            <div class="card-header">
              <h1 id="titulo" class="card-title text-white">Acceso al Sitio Web</h1>
            </div>
                <div class="card-body">
                  <form id="formAcceso" method="post" action="servicios/validarAcceso.php">
                      <div class="row">
                          <div class="col-md-12" style="text-align:center;">
                              <img id="logo" src="img/pizza.png" alt="logo"/>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="form-group row">
                                  <div class="col-md-12">

                                      <input class="form-control" placeholder="Usuario" id="loginname" name="loginname" type="text" autofocus>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <div class="col-md-12">
                							        <input class="form-control" placeholder="Contraseña" id="password" name="password" type="password" value="" onkeypress="enter(event)">
                                        </div>
                                    </div>
                              <div class="form-group">
                                  <button type="button" onclick="validarCampos();" id="botonIngresar" class="btn btn-lg btn-primary btn-block">Ingresar
                                  </button>
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
