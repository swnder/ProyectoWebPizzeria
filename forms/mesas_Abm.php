<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <?php require_once "../plantilla/linktablas.php";?>
          <title>Sistema Pizzeria/AbM_Mesas</title>
          <?php
               if (!isset($_GET["accion"])){
                    header("Location: malaidea.php");
               }
          ?>
     </head>

     <body class="text-white">
       <?php
            if (isset($_GET['id'])){ //Solo para modificar
                 require_once("../servicios/conexion.php");
           $conex = conexion();
       $id = $_GET['id'];
       $sql = "SELECT * FROM ciudad WHERE id = '$id'";
       $res = mysqli_query($conex, $sql);

       $reg = mysqli_fetch_array($res);
     }
   ?>
      <h1 class="bg-dark">Datos a mostrar: <?php echo isset($_GET['id']) ? $_GET['id'] : '';?></h1>
          <div class="container gris">
               <h2 class="text-center mt-3 font-weight-bold" id="titulo"></h2>
               <div class="row" id="row">
                    <div class="col">

                         <!-- se le agrega la validación para que no acepte el enter al enviar el submit -->
                         <form id="form_mesa" onkeypress="if(event.keyCode == 13) event.returnValue =validarCampos();">
                              <!-- PRIMERA FILA -->

                              <div class="form-group row mt-3">

                                   <div class="col-12 col-md-4">
                                       <label class="font-weight-bold" for="descri">DESCRIPCION</label>
                                       <textarea class="form-control rounded-0" id="descri" name="descri" rows="3" placeholder="Describa brevemente" value="" autofocus></textarea>

                                   </div>

                                    <div class="col-12 col-md-4">
                                        <label class="font-weight-bold" for="ubi">UBICACION</label>
                                        <textarea class="form-control rounded-0" id="ubi" name="ubi" rows="3" placeholder="Ubicacion dentro del local"></textarea>

                                    </div>

                                    <div class="col-12 col-md-2">
                                        <label class="font-weight-bold" for="sillas">SILLAS</label><br>
                                        <input type="number" name="sillas" id="sillas" required min="2" max="8" maxlength="8" placeholder="0"  value="">
                                    </div>




                                  </div>
                                <!-- CUARTA FILA -->
                                <div class="form-group row">
                                  <div class="col-12 col-md-4 mb-2">
                                    <button class="btn gris btn-block" type="button" onclick="validarCampos();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                                  </div>

                                  <div class="col-12 col-md-4 mb-2">
                                    <button class="btn gris btn-block" type="button" onclick="cancelar();"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
                                  </div>

                                  <div class="col-12 col-md-4 mb-2">
                                    <button type="button" class="btn gris btn-block" onclick="window.location.href='mesas_lista.php';"><i class="fa fa-table"></i> Ir a lista de Mesas</button>
                                  </div>
                                </div>

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
                              document.getElementById('titulo').innerHTML = 'ALTA DE MESAS';
                              document.title = 'Sistema Pizzeria/Mesas Alta';
                         </script>";
                    }else if ($_GET["accion"] == "M"){
                         echo "<script>
                              document.getElementById('accion').value = 'M';
                              document.getElementById('titulo').innerHTML = 'MODIFICAR MESAS';
                              document.title = 'Sistema Pizzeria/Mesas Modificar';
                         </script>";
                    }
               }
          ?>
          <script>
               document.getElementById("sillas").focus(); //Cuando es Modificar





               function registrar(){
                    var datos = $("#form_mesa").serialize();
                     // descripcion = $("#descri").val();
                     // ubi = $("#ubi").val();
                     // silla = $("$silla").val();
                     // acc = $("#accion").val();
                    // alert(datos);
                    //  return false;
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/MesasServicios.php",
                         // data: "ciudad=" + ciu + "&depar=" + depar + "&accion=" + acc,
                         data: datos,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 1){
                              alertify.warning("La Mesa ya existe. Cambie por otro");
                              $("#ubi").focus();
                         }else if (resp == 2){
                              alertify.success("Registro guardado con éxito");
                              limpiarCampos();
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }

               function limpiarCampos(){
                    $("#descri").val("");
                    $("#ubi").val("");
                    $("#sillas").val("");
                    $("#descri").focus();

               }

               function validarCampos(){
                        if($("#descri").val()==""){
                          alertify.error("Debes de escribir una Descrición");
                          $("#descri").focus();
                        }else if($("#ubi").val()==""){
                          alertify.error("Debes de Especificar la ubicación");
                          $("#ubi").focus();
                        }else if ($("#sillas").val()=="") {
                          alertify.error("El campo no puede estar vacío!");
                          $("#sillas").focus();
                        }else if ($("#accion").val() == "N"){
                              registrar();
                         }else if ($("#accion").val() == "M"){
                            // alertify.error("holi");
                              actualizar();

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
                                        window.location="mesas_lista.php";
                                   }
                              );
                         }

                    },
                    function(){
                         alertify.error("Puede continuar con la carga de datos");
                    }).set("labels", {ok:"SI", cancel:"NO"});
                    $("#descri").focus();
               }



               function actualizar(){

                    // descri = $("#descri").val();
                    // ubi = $("#ubi").val();
                    // sillas = $("#sillas").val();
                    // acc = $("#accion").val();
                    // id  = $("#id").val();
                    var datos = $("#form_mesa").serialize();
                // alert(datos);
                // return false;
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/MesasServicios.php",
                         // data: "descri=" + descri + "&ubi=" + ubi + "&sillas=" +sillas +"&accion=" + acc  + "&id=" + id,
                         data: datos,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 3){
                              alertify.warning("La Mesa ya existe. Cambie por otro");
                              $("#ubi").focus();
                         }else if (resp == 4){
                              alertify.alert("Modificar", "Registro actualizado con éxito",
                                   function(){
                                        window.location="../forms/mesas_lista.php";
                                   }
                              );
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }

               seleccionarTipoCliente();
          </script>
     </body>
</html>
