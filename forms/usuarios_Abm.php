<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <link rel="icon" href="../img/user.ico"/>
          <!-- para el ojito de la contraseña -->
          <link rel="stylesheet" href="../css/strength.css">
          <!-- script de password -->
          <script src="../js/password_strength.js"> </script>
          <!-- para la fortaleza -->
          <script src="../js/jquery-strength.js"></script>
          <script src="../js/funciones.js"></script>

          <?php require_once "../plantilla/linktablas.php";?>

          <title>Sistema Pizzeria/AbM_Usuarios</title>


          <?php
               if (!isset($_GET["accion"])){
                    header("Location: malaidea.php");
               }
          ?>
     </head>

     <body>


          <?php
               if (isset($_GET['id'])){ //Solo para modificar
                    require_once("../servicios/conexion.php");
          		$conex = conexion();
     			$id = $_GET['id'];
     			$sql = "SELECT * FROM usuario WHERE id = '$id'";
     			$res = mysqli_query($conex, $sql);
     			$reg = mysqli_fetch_array($res);
     		}
     	?>
          <div class="container gris">
               <h2 class="text-center text-white mt-3" id="titulo"></h2>
               <div class="row text-white" id="row">
                    <div class="col">
                         <!-- <form id="formulario" action="../servicios/clientesServicios.php" method="post"> -->
                         <!-- <form name="form_clientes" onsubmit="return false" action="return false"> -->
                     <form id="form_usuario" onkeypress="if(event.keyCode == 13) event.returnValue =validarCampos();">
                              <!-- PRIMERA FILA -->
                              <div class="form-group row mt-3">

                                   <div class="col-12 col-md-6">
                                        <label class="font-weight-bold" for="usuario">USUARIO</label>
                                        <input type="text" class="form-control text-uppercase" name="usuario" id="usuario" placeholder="Ingrese un Usuario" maxlength="50" autofocus value="<?php echo isset($reg['usuario']) ? $reg['usuario'] : '';?>">
                                   </div>
                                   <!-- nivel -->
                     <div class="col-12 col-md-6 mb-3">
                         <label class="font-weight-bold" for="nivel">NIVEL</label>
                         <select name="nivel" id="nivel" class="form-control" required value>

                         <option value="<?php echo isset($reg['nivel']) ? $reg['nivel'] : '';?>"><?php echo isset($reg['nivel']) ? $reg['nivel'] : '';?></option>

                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                        <option value="USUARIO">USUARIO</option>
                     </select>
                                  </div>

                               </div>
                               <!-- segunda fila -->

                               <div class="form-group row mt-3">

                                 <div class="col-12 col-md-6 mb-3">
                                      <label class="font-weight-bold" for="pass">PASSWORD</label>
                                      <input type="password" class="check-seguridad form-control" name="pass" id="pass" placeholder="Ingrese una Contraseña" onkeypress="return validarRuc(event)" maxlength="15" value="<?php echo isset($reg['pass']) ? $reg['pass'] : '';?>">
                                 </div>
                                 <div class="col-12 col-md-6 mb-3">
                                      <label class="font-weight-bold " for="pass2">CONFIRMA EL PASSWORD</label>
                                      <input type="password" class="form-control check-seguridad" name="pass2" id="pass2" placeholder="VUELVA A INGRESAR LA MISMA CONTRASEÑA" onkeypress="return validarRuc(event)" maxlength="15" autofocus>
                                 </div>

                               </div>

                                <!-- TERCERA FILA -->
                     					<div class="form-group row">
                     						<div class="col-12 col-md-4 mb-2">
                     							<button class="btn gris btn-block" type="button" onclick="validarCampos();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                     						</div>

                     						<div class="col-12 col-md-4 mb-2">
                     							<button class="btn gris btn-block" type="button" onclick="cancelar();"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
                     						</div>

                     						<div class="col-12 col-md-4 mb-2">
                     							<button type="button" class="btn gris btn-block" onclick="window.location.href='usuarios_lista.php';"><i class="fa fa-table"></i> Ir a lista de Usuarios</button>
                     						</div>
                     					</div>
                                <!-- manda datos con el formulario -->
                                              <input type="hidden" name="accion" id="accion">
                                              <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '';?>">

                    </form>
              </div>
          </div>
       </div>


          <?php
               if (isset($_GET["accion"])){
                    if ($_GET["accion"] == "N"){
                         echo "<script>
                              document.getElementById('accion').value = 'N';
                              document.getElementById('titulo').innerHTML = 'ALTA DE USUARIO';
                              document.title = 'Sistema Pizzeria/USUARIO Alta';
                         </script>";
                    }else if ($_GET["accion"] == "M"){
                         echo "<script>
                              document.getElementById('accion').value = 'M';
                              document.getElementById('titulo').innerHTML = 'MODIFICAR USUARIO';
                              document.getElementById('usuario').attr('readonly','readonly');
                              document.getElementById('usuario').addClass('readonly');
                              document.getElementById('pass2').focus();
                              document.title = 'Sistema Pizzeria/USUARIO Modificar';
                         </script>";
                    }
               }
          ?>
          <script>
               document.getElementById("pass2").focus(); //Cuando es Modificar
               // apartir de aqui funcional los botones

               function registrar(){
                     user = $("#usuario").val();
                     nivel = $("#nivel").val();
                     pass = $("#pass").val();
                     acc = $("#accion").val();
                      // var datos = $("#form_usuario").serialize();
                      //  alert(datos);
                      //  return false;
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/UsuariosServicios.php",
                         data: "usuario=" + user + "&nivel=" + nivel + "&pass=" +pass+ "&accion=" + acc,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 1){
                              alertify.warning("El usuario ya existe. Cambie por otro");
                              $("#usuario").focus();
                         }else if (resp == 2){
                              alertify.success("Registro guardado con éxito");
                              limpiarCampos();
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }

               function limpiarCampos(){
                    $("#usuario").val("");
                    $("#nivel").val("");
                    $("#pass").val("");
                    $("#pass2").val("");
                    $("#usuario").focus();

               }

               function validarCampos(){

                     if ($("#usuario").val().length < 5){
                         alertify.error("Ingrese como mínimo 5 caracteres el Usuario");
                         $("#usuario").focus();
                    }else if ($("#nivel").val() == ""){
                         alertify.error("Seleccione el Nivel");
                         $("#nivel").focus();
                    }else if ($("#pass").val() == "" || $("#pass").val().length < 3){
                         alertify.error("Introduzca una contraseña mayor que 3 caracteres");
                         $("#pass").focus();
                    }else if ($("#pass2").val() == "" || $("#pass2").val().length < 3){
                         alertify.error("Introduzca una contraseña valida");
                         $("#pass2").focus();
                    }else if (accion == "M") {
                        if(!($("#pass").val() == MD5($("#pass2").val()))){
                          alertify.error("Las contraseñas no son iguales");
                          $("#pass2").focus();
                        }

                    }else if(!($("#pass").val() == $("#pass2").val())){
                      alertify.error("Las contraseñas no son iguales");
                      $("#pass2").focus();
                    }
                    else{

                         if ($("#accion").val() == "N"){
                              registrar();
                         }else if ($("#accion").val() == "M"){
                              actualizar();
                         }
                    }
               }// fin validarCampos

               function cancelar(){
                    alertify.confirm("Confirmación", "¿Desea cancelar la carga de datos y limpiar los campos?",
                    function(){
                         if($("#accion").val() == "N"){
                              alertify.error("Operación cancelada. Se limpiaron los campos");
                              limpiarCampos();
                         }else if($("#accion").val() == "M"){
                              alertify.alert("Atención", "Operación cancelada",
                                   function(){
                                        window.location="ciudadlista.php";
                                   }
                              );
                         }

                    },
                    function(){
                         alertify.error("Puede continuar con la carga de datos");
                    }).set("labels", {ok:"SI", cancel:"NO"});
                    $("#usuario").focus();
               }

               // function seleccionarTipoCliente(){
               //      t = $("#nivel").val();
               //      if (t != ""){
               //           sel = document.getElementById("nivel");
               //           for (var i = 0; i < sel.length; i++) {
               //                if(sel[i].value == t){
               //                     sel.selectedIndex = i;
               //                     break;
               //                }
               //           }
               //      }
               // }

               function actualizar(){
                      var datos = $("#form_usuario").serialize();
                       // user = $("#usuario").val();
                       // nivel = $("#nivel").val();
                       // pass = $("#pass").val();
                       // acc = $("#accion").val();
                       // alert(datos);
                       // return false;
                       $.ajax({
                            type: "POST",
                            dataType: 'html',
                            url: "../servicios/UsuariosServicios.php",
                            // data: "usuario=" + user + "&nivel=" + nivel + "&pass="+pass+"&accion=" + acc,
                            data: datos,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 3){
                              alertify.warning("El usuario ya existe. Cambie por otro");
                              $("#user").focus();
                         }else if (resp == 4){
                              alertify.alert("Modificar", "Registro actualizado con éxito",
                                   function(){
                                        window.location="../forms/usuarios_lista.php";
                                   }
                              );
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }


          </script>


     </body>
</html>
