<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <link rel="icon" href="../img/ciudad.ico"/>
          <?php include "../plantilla/linktablas.php"; ?>
          <title>Sistema Pizzeria/AbM_Ciudad</title>
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
     			$sql = "SELECT * FROM categoria WHERE id = '$id'";
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
                         <form id="form_categoria" onkeypress="if(event.keyCode == 13) event.returnValue =validarCampos();">
                              <!-- PRIMERA FILA -->
                              <div class="form-group row mt-3">

                                   <div class="col-12 col-md-6">
                                        <label class="font-weight-bold" for="ciudad">CATEGORIA</label>
                                            <input type="text" class="form-control text-uppercase" name="ciudad" id="ciudad" placeholder="Ingrese Categoria" maxlength="50" value="<?php echo isset($reg['categoria']) ? $reg['categoria'] : '';?>">
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
                           							<button type="button" class="btn gris btn-block" onclick="window.location.href='categoria_lista.php';"><i class="fa fa-table"></i> Ir a lista de Categoria</button>
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
                              document.getElementById('titulo').innerHTML = 'ALTA DE CATEGORIA';
                              document.title = 'Sistema Pizzeria/CATEGORIA ALTA';
                         </script>";
                    }else if ($_GET["accion"] == "M"){
                         echo "<script>
                              document.getElementById('accion').value = 'M';
                              document.getElementById('titulo').innerHTML = 'MODIFICAR CIUDAD';
                              document.title = 'Sistema Pizzeria/CATEGORIA MODIFICAR';
                         </script>";
                    }
               }

          ?>

          <script>
               document.getElementById("ciudad").focus(); //Cuando es Modificars


              function registrar(){
                   var datos = $("#form_categoria").serialize();
                    // descripcion = $("#descri").val();
                    // ubi = $("#ubi").val();
                    // silla = $("$silla").val();
                    // acc = $("#accion").val();
                    // alert(datos);
                    // return false;
                   $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "../servicios/CategoriaServicios.php",
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
                    $("#ciudad").val("");
                    $("#ciudad").focus();
               }

               function validarCampos(){

                     if ($("#ciudad").val().length < 5){
                         alertify.error("Ingrese como mínimo 5 caracteres la Categoia");
                         $("#ciudad").focus();
                    }else{
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
                                     window.location="categoria_lista.php";
                                   }

                              );
                         }

                    },function(){
                         alertify.error("Puede continuar con la carga de datos");
                    }).set("labels", {ok:"SI", cancel:"NO"});
                    $("#ciudad").focus();
               }



               function actualizar(){
                   var datos = $("#form_categoria").serialize();
                    // ciu = $("#ciudad").val();
                    // depar = $("#depar").val();
                    // acc = $("#accion").val();
                    // id  = $("#id").val();
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/CategoriaServicios.php",
                         // data: "ciudad=" + ciu + "&depar=" + depar + "&accion=" + acc  + "&id=" + id,
                         data:datos,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 3){
                              alertify.warning("La categoria ya existe. Cambie por otro");
                              $("#depar").focus();
                         }else if (resp == 4){
                              alertify.alert("Modificar", "Registro actualizado con éxito",
                                   function(){
                                        window.location="../forms/categoria_lista.php";
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
