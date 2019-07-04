<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <link rel="icon" href="../img/ciudad.ico"/>

          <!-- CSS REQUERIDOS -->
          <link rel="stylesheet" href="../css/misestilos1.css">
          <!-- Bootstrap -->
          <link rel="stylesheet" href="../bt/bootstrap.min.css">
          <!-- Datatables -->
          <link rel="stylesheet" href="../dt/datatables.min.css">
          <!-- Alertify -->
          <link rel="stylesheet" href="../alertify/alertify.min.css">
          <link rel="stylesheet" href="../alertify/default.min.css">
          <!-- Font-Awesome -->
          <link rel="stylesheet" href="../font-awesome/font-awesome.min.css">

          <!-- JS REQUERIDOS -->
          <!-- JQuery -->
          <script src="../js/jquery-3.3.1.min.js"></script>
          <!-- Boostrap -->
          <script src="../bt/bootstrap.min.js"></script>
          <!-- Datatables -->
          <script src="../dt/datatables.min.js"></script>
          <!-- Datatables Botones-->
          <script src="../dt/botones/dataTables.buttons.min.js"></script>
          <script src="../dt/botones/buttons.html5.min.js"></script>
          <script src="../dt/botones/jszip.min.js"></script>
          <script src="../dt/botones/buttons.print.min.js"></script>
          <script src="../dt/botones/pdfmake.min.js"></script>
          <script src="../dt/botones/vfs_fonts.js"></script>
          <!-- Alertify -->
          <script src="../alertify/alertify.min.js"></script>
          <title>Marca</title>
          <?php
               if (!isset($_GET["accion"])){
                    header("Location: malaidea.php");
               }
          ?>
     </head>

     <body class="bg-dark text-white">
          <?php
               if (isset($_GET['id'])){ //Solo para modificar
                    require_once("../servicios/conexion.php");
          		$conex = conexion();
     			$id = $_GET['id'];
     			$sql = "SELECT * FROM marca WHERE id = '$id'";
     			$res = mysqli_query($conex, $sql);
     			$reg = mysqli_fetch_array($res);
     		}
     	?>
          <div class="container gris">
               <h2 class="text-center mt-3 font-weight-bold" id="titulo"></h2>
               <div class="row" id="row">
                    <div class="col">
                         <!-- <form id="formulario" action="../servicios/clientesServicios.php" method="post"> -->
                         <!-- <form name="form_clientes" onsubmit="return false" action="return false"> -->
                         <form id="form_ciudad" onkeypress="if(event.keyCode == 13) event.returnValue =validarCampos();">
                              <!-- PRIMERA FILA -->
                              <div class="form-group row mt-3">

                                   <div class="col-12 col-md-6">
                                        <label class="font-weight-bold" for="ciudad">MARCAS</label>
                                            <input type="text" class="form-control text-uppercase" name="marca" id="marca" placeholder="Ingrese Marca" maxlength="50" value="<?php echo isset($reg['marca']) ? $reg['marca'] : '';?>" autofocus>
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
                           							<button type="button" class="btn gris btn-block" onclick="window.location.href='marca_lista.php';"><i class="fa fa-table"></i> Ir a lista de ciudad</button>
                           						</div>
                     					</div>
                                <input type="hidden" name="accion" id="accion">
                                <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '';?>">
                                <input type="hidden" name="marca" id="marca" value="<?php echo isset($reg['marca']) ? $reg['marca'] : '';?>">

                         </form>
                    </div>
               </div>
          </div>

          <?php
               if (isset($_GET["accion"])){
                    if ($_GET["accion"] == "N"){
                         echo "<script>
                              document.getElementById('accion').value = 'N';
                              document.getElementById('titulo').innerHTML = 'ALTA DE MARCA';
                         </script>";
                    }else if ($_GET["accion"] == "M"){
                         echo "<script>
                              document.getElementById('accion').value = 'M';
                              document.getElementById('titulo').innerHTML = 'MODIFICAR MARCA';

                         </script>";
                    }
               }
          ?>
          <script>

               function registrar(){
                    // var datos = $("#form_ciudad").serialize();
                     marca = $("#marca").val();
                     acc = $("#accion").val();
                    // alert(ciu+depar+acc);
                    // return false;
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/marcaServicios.php",
                         data: "marca=" + marca  + "&accion=" + acc,
                         // data: datos,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 1){
                              alertify.warning("El marca  ya existe. Cambie por otro");
                              $("#marca").focus();
                         }else if (resp == 2){
                              alertify.success("Registro guardado con éxito");
                              limpiarCampos();
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }

               function limpiarCampos(){
                    $("#marca").val("");
                    $("#marca").focus();
               }

               function validarCampos(){

                     if ($("#marca").val().length < 4){
                         alertify.error("Ingrese como mínimo 4 caracteres la Marca");
                         $("#marca").focus();
                    }else{
                         if ($("#accion").val() == "N"){
                              registrar();
                              alertify.success("Registro guardado con éxito");
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
                                        window.location="marca_lista.php";
                                   }
                              );
                         }

                    },function(){
                         alertify.error("Puede continuar con la carga de datos");
                    }).set("labels", {ok:"SI", cancel:"NO"});
                    $("#sabores").focus();
               }


               function actualizar(){
                    marca = $("#marca").val();
                    acc = $("#accion").val();
                    id  = $("#id").val();
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/marcaServicios.php",
                         data: "marca=" + marca + "&accion=" + acc  + "&id=" + id,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 3){
                              alertify.warning("El marca ya existe. Cambie por otro");
                              $("#marca").focus();
                         }else if (resp == 4){
                              alertify.alert("Modificar", "Registro actualizado con éxito",
                                   function(){
                                        window.location="../forms/marca_lista.php";
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
