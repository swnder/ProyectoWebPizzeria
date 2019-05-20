<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Apertura de CAJA</title>
    <link rel="icon" href="../img/pizzeria.ico"/>
    <?php include "../plantilla/linktablas.php"; ?>
    <?php
         if (!isset($_GET["accion"])){
              header("Location: malaidea.php");
         }
    ?>
  </head>
  <body>
    <!-- cabecera -->
    <?php require_once "../plantilla/cabecera.php"; ?>
      <?php
          session_start();
          if (isset($_SESSION["idUsuario"])){ //Solo para modificar
            require_once("../servicios/conexion.php");
            $conex = conexion();
            $id = $_SESSION["idUsuario"];
            $sql = "SELECT usuario FROM empleado WHERE usuario = '$id'";
            $res = mysqli_query($conex, $sql);
            $reg = mysqli_fetch_array($res);
          }
      ?>
    <div class="container gris">
         <h2 class="text-center mt-3 font-weight-bold" id="titulo"></h2>
         <div class="row" >
              <div class="col">
                   <!-- <form id="formulario" action="../servicios/clientesServicios.php" method="post"> -->
                   <!-- <form name="form_clientes" onsubmit="return false" action="return false"> -->
                   <form id="form_categoria" onkeypress="if(event.keyCode == 13) event.returnValue =validarCampos();">
                      <!-- PRIMERA FILA -->
                        <div class="form-group row mt-3">
                              <div class="col-12 col-md-4">

                              </div>
                              <div class="col-12 col-md-4">

                                   <label class="font-weight-bold" for="monto">Nro.Caja</label>
                                       <input type="number" class="form-control text-uppercase" name="nrocaja" id="nrocaja" placeholder="Caja Nro." maxlength="10" required min="1">
                              </div>
                             <div class="col-12 col-md-4">

                                  <label class="font-weight-bold" for="monto">MONTO</label>
                                      <input type="number" class="form-control text-uppercase" name="monto" id="monto" placeholder="Ingrese el MONTO" maxlength="100" required min="200000">
                             </div>
                            </div>
                                              <!-- CUARTA FILA -->
                              <div class="form-group row">
                                <div class="col-12 col-md-4 mb-2">
                                  <button class="btn gris btn-block" type="button" onclick="validarCampos();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                                </div>
                                <div class="col-12 col-md-4 mb-2">

                                </div>
                                <div class="col-12 col-md-4 mb-2">
                                  <button class="btn gris btn-block" type="button" onclick="cancelar();"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
                                </div>

                        </div>
                          <input type="hidden" name="accion" id="accion">
                          <input type="hidden" name="idusuario" id="idusuario"value="<?php echo isset($reg['usuario']) ? $reg['usuario'] : ''; ?>">


                   </form>
              </div>
         </div>
    </div>

    <?php
         if (isset($_GET["accion"])){
              if ($_GET["accion"] == "A"){
                   echo "<script>
                        document.getElementById('accion').value = 'A';
                        document.getElementById('titulo').innerHTML = 'APERTURA DE CAJA';
                        document.title = 'Sistema Pizzeria/APERTURA DE CAJA';
                   </script>";
              }else if ($_GET["accion"] == "C"){
                   echo "<script>
                        document.getElementById('accion').value = 'C';
                        document.getElementById('titulo').innerHTML = 'CIERRE DE CAJA';
                        document.title = 'Sistema Pizzeria/CIERRE DE CAJA';
                   </script>";
              }
         }

    ?>

    <script>
         document.getElementById("nrocaja").focus(); //Cuando es Modificars

        function registrar(){
             var datos = $("#form_categoria").serialize();
              // alert(datos);
              // return false;
             $.ajax({
                  type: "POST",
                  dataType: 'html',
                  url: "../servicios/CajaServicio.php",
                  // data: "ciudad=" + ciu + "&depar=" + depar + "&accion=" + acc,
                  data: datos,
             }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                  if (resp == 1){
                    // alertify.success("hola es el 1");
                    alertify.alert("Atención", "NO! puede cargar En esta Fecha",
                    function(){
                      alertify.error('Ok');
                      window.location="../menuAdmin.php";
                    });
                  }else if (resp == 2){
                    // alertify.success("hola es el 2");
                    alertify.alert("Exito", "Carga Completada ",
                    function(){
                       alertify.success('Ok');
                      window.location="../menuAdmin.php";
                    });
                  }else if(resp==3){
                    alertify.success("Tembo la rejapova");
                  }
             }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                  alertify.error(resp);
             });
        }


         function validarCampos(){
            if($("#nrocaja").val()<1){
                alertify.error("El nro incorrecto");
                $("#nrocaja").focus();
            }else if ($("#monto").val()<200000){
                   alertify.error("El monto no puede ser menor que 200000 Gs.");
                   $("#monto").focus();
            }else{
                   if ($("#accion").val() == "A"){
                        registrar();
                   }else if ($("#accion").val() == "C"){
                        registrar();
                   }
              }
         }// fin validarCampos

         function cancelar(){
              alertify.confirm("Confirmación", "¿Desea cancelar la Operacion?",
              function(){
                   if($("#accion").val() == "A"){
                        alertify.alert("Atención", "Operación cancelada",
                        function(){
                          window.location="../menuAdmin.php";
                        });
                   }else if($("#accion").val() == "C"){
                        alertify.alert("Atención", "Operación cancelada",
                             function(){
                               window.location="../menuAdmin.php";
                             }

                        );
                   }

              },function(){
                   alertify.error("Puede continuar con la carga de datos");
              }).set("labels", {ok:"SI", cancel:"NO"});
              $("#nrocaja").focus();
         }


    </script>



  </body>
</html>
