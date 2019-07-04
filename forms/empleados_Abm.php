<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
            <link rel="icon" href="../img/pizzeria.ico"/>
      <?php require_once "../plantilla/linktablas.php";?>
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
     			$sql = "SELECT * FROM empleado WHERE id = '$id'";
     			$res = mysqli_query($conex, $sql);
     			$reg = mysqli_fetch_array($res);
     		}
     	?>
          <div class="container gris">
               <h2 class="text-center mt-3 " id="titulo"></h2>
               <div class="row mb-3" id="row">
                    <div class="col mb-3">
                         <!-- <form id="formulario" action="../servicios/clientesServicios.php" method="post"> -->
                         <!-- <form name="form_clientes" onsubmit="return false" action="return false"> -->
                         <form id="form_empleados" onkeypress="if(event.keyCode == 13) event.returnValue =validarCampos();">
                              <!-- PRIMERA FILA -->
                              <div class="form-group row mt-3" >

                                   <div class="col-12 col-md-2 mb-3">
                                        <label class="font-weight-bold" for="ci">C.I.</label>
                                        <input type="text" class="form-control" name="ci" id="ci" placeholder="Ingrese su C.I." onkeypress="return validarRuc(event)" maxlength="15" autofocus value="<?php echo isset($reg['ci']) ? $reg['ci'] : '';?>">

                                   </div>

                                   <div class="col-12 col-md-4 mb-3">
                                        <label class="font-weight-bold" for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese Nombre Completo" maxlength="50" pattern="^[A-Za-z]+$" value="<?php echo isset($reg['nombre']) ? $reg['nombre'] : '';?>">
                                   </div>

                                   <div class="col-12 col-md-4 mb-3">
                                        <label class="font-weight-bold" for="apellido">Apellido</label>
                                        <input type="text" class="form-control " name="apellido" id="apellido" pattern="^[A-Za-z]+$" placeholder="Ingrese Apellido Completo" maxlength="50" value="<?php echo isset($reg['apellido']) ? $reg['apellido'] : '';?>">
                                   </div>


                              </div>

                              <!-- SEGUNDA FILA -->
                              <div class="form-group row">
                                <div class="col-12 col-md-4 mb-3">
                                     <label class="font-weight-bold" for="fechanaci">Fecha Nac.</label>
                                     <input type="date" class="form-control" name="fechanaci" id="fechanaci"   value="<?php echo isset($reg['fechanaci']) ? $reg['fechanaci'] : '';?>" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                </div>

                                   <div class="col-12 col-md-2 mb-3">
                                        <label class="font-weight-bold" for="nacionalidad">NACIONALIDAD</label>
                                        <input type="text" class="form-control" name="nacionalidad" id="nacionalidad" placeholder="Paraguaya" pattern="^[A-Za-z]+$" maxlength="50" value="<?php echo isset($reg['nacionalidad']) ? $reg['nacionalidad'] : '';?>">
                                   </div>
                                   <div class="col-12 col-md-2">
                                        <label class="font-weight-bold" for="telef">TELÉFONO</label>
                                        <input type="text" class="form-control" name="telef" id="telef" placeholder="09xxxxxxxx" onkeypress="return validarRuc(event)" maxlength="10" value="<?php echo isset($reg['telefono']) ? $reg['telefono'] : '';?>">
                                   </div>
                                   <div class="col-12 col-md-2 mb-3">
                                        <label class="font-weight-bold" for="barrio">BARRIO</label>
                                        <input type="text" class="form-control" name="barrio" id="barrio" pattern="^[A-Za-z]+$" placeholder="Ingrese barrio" maxlength="50" value="<?php echo isset($reg['barrio']) ? $reg['barrio'] : '';?>">
                                   </div>
                                     <!-- fin ciudadciudad -->
                					</div>

                              <!-- CUARTA FILA -->

                              <div class="from-group row">
                                <div class="col-12 col-md-4 mb-3">
                                     <label class="font-weight-bold" for="direccion">DIRECCION</label>
                                     <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingrese dirección" maxlength="50" value="<?php echo isset($reg['direccion']) ? $reg['direccion'] : '';?>">
                                </div>
                                <div class="col-12 col-md-2 mb-3">
                                  <label for="ciudad" class="col-sm-4 control-label">CIUDAD:</label>
                                  <select id="idciudad" name="idciudad" class="form-control">
                                    <?php
                                      require_once("../servicios/conexion.php");
                                      $con = conexion();
                                      $sql = "SELECT * FROM ciudad";
                                      $res = mysqli_query($con, $sql);
                                        foreach ($res as $row) {
                                            echo "<option value='".$row["id"]."'>".$row["ciudad"]."</option>";
                                        }
                                    ?>
                                  </select>
                                  </div>
                                <div class="col-12 col-md-3 mb-3">
                                  <label class="font-weight-bold" for="cargo">Cargo</label>
                                  <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo" maxlength="50" value="<?php echo isset($reg['cargo']) ? $reg['cargo'] : '';?>">
                                </div>
                              <!-- USUARIO -->
                              <div class="col-12 col-md-2 mb-3">
                                <label for="usuario" class="font-weight-bold">USUARIO:</label>
                                  <select id="usuario" name="usuario" class="form-control">
                                    <?php
                                      require_once("../servicios/conexion.php");
                                      $con = conexion();
                                      $sql = "SELECT * FROM usuario";
                                      $res = mysqli_query($con, $sql);
                                                  foreach ($res as $row) {
                                                      echo "<option value='".$row["id"]."'>".$row["usuario"]."</option>";
                                                  }
                                    ?>
                                  </select>
                                </div>

                              </div>

                   					<div class="form-group row">
                              	<div class="col-12 col-md-4 mb-2">
                   							<button class="btn gris btn-block" type="button" onclick="validarCampos();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                   						</div>

                   						<div class="col-12 col-md-4 mb-2">
                   							<button class="btn gris btn-block" type="button" onclick="cancelar();"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
                   						</div>
                   						<div class="col-12 col-md-4 mb-2">
                   							<button type="button" class="btn gris btn-block" onclick="window.location.href='empleados_lista.php';"><i class="fa fa-table"></i> Ir a lista de Empleados</button>
                   						</div>
                   					</div>
                              <input type="hidden" name="accion" id="accion">
                              <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '';?>">

                              <input type="hidden" name="rucSinModif" id="rsm" value="<?php echo isset($reg['ci']) ? $reg['ci'] : '';?>">

                         </form>
                    </div>
               </div>
          </div>

          <?php
               if (isset($_GET["accion"])){
                    if ($_GET["accion"] == "N"){
                         echo "<script>
                              document.getElementById('accion').value = 'N';
                              document.getElementById('titulo').innerHTML = 'ALTA DE EMPLEADOS';
                              document.title = 'Alta de Empledos';
                         </script>";
                    }else if ($_GET["accion"] == "M"){
                         echo "<script>
                              document.getElementById('accion').value = 'M';
                              document.getElementById('titulo').innerHTML = 'MODIFICAR EMPLEADOS';
                              document.title = 'Modificar Empleados';
                              document.getElementById('ci').readOnly=true;
                              document.getElementById('usuario').disabled;

                         </script>";
                    }
               }
          ?>
          <script>
               document.getElementById("ci").focus(); //Cuando es Modificar para que seleccione el Tipo de cliente
               function validarRuc(e){
                    tecla = (document.all) ? e.keyCode : e.which;
                    tecla = String.fromCharCode(tecla);
                    return /^[0-9\-]+$/.test(tecla);
               }

               function registrar(){
                    var datos = $("#form_empleados").serialize();
                     //  alert(datos);
                     // return false;
                    $.ajax({

                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/EmpleadoServicios.php",
                         //
                         // data: "ruc=" + ruc + "&razon=" + raz + "&telefono=" + tel + "&direccion=" + dir + "&idciudad=" + ciu +"&accion=" + acc,
                         data: datos,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 2){
                              alertify.warning("El C.I. ingresado ya existe. Cambie por otro");
                              $("#ci").focus();

                         }else if (resp == 1){
                           alertify.warning("El Usuario ingresado ya existe. Cambie por otro");
                           $("#usuario").focus();
                         }else if (resp == 3){
                              alertify.success("Registro guardado con éxito");
                              limpiarCampos();
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                         alertify.error("nose que paso");
                    });
               }

               function limpiarCampos(){
                    $("#ci").val("");
                    $("#nombre").val("");
                    $("#apellido").val("");
                    $("#fechanaci").val("");
                    $("#nacionalidad").val("");
                    $("#telef").val("");
                    $("#barrio").val("");
                    $("#direccion").val("");
                    $("#idciudad").val("");
                    $("#cargo").val("");
                    $("#usuario").val("");
                    $("#ci").focus();
               }

               function validarCampos(){
                    if ($("#ci").val().length < 6){
                         alertify.error("Ingrese como mínimo 6 dígitos en C.I.");
                         $("#ci").focus();
                    }else if ($("#nombre").val().length < 5){
                         alertify.error("Ingrese como mínimo 5 caracteres en el NOMBRE");
                         $("#nombre").focus();
                    }else if($("#apellido").val().length < 5){
                      alertify.error("Ingrese como mínimo 5 caracteres en el APELLIDO");
                      $("#apellido").focus();
                    }else if($("#fechanaci").val()<"1696-01-01"||!($("#fechanaci").val())) {
                      document.getElementById("fechanaci").focus();
                      alertify.error("Ingrese una fecha valida");
                    }else if(!($("#nacionalidad").val())){
                      alertify.error("Ingrese la Nacionalidad valida ");
                      $("#nacionalidad").focus();
                    }else if(!($("#telef").val())||$("#telef").val()<0){
                      alertify.error("Ingrese el Telefono valido ");
                      $("#telef").focus();
                    }else if(!($("#barrio").val())){
                      alertify.error("Ingrese el Barrio ");
                      $("#barrio").focus();
                    }else if(!($("#direccion").val())){
                      alertify.error("Ingrese la Direccion ");
                      $("#direccion").focus();
                    }else if(!($("#idciudad").val())){
                      alertify.error("Ingrese la Ciudad ");
                      $("#idciudad").focus();
                    }else if(!($("#cargo").val())){
                      alertify.error("Ingrese El Cargo ");
                      $("#cargo").focus();
                    }else if(!($("#usuario").val())){
                        alertify.error("Ingrese el Usuario ");
                        $("#usuario").focus();
                    }else {

                         if ($("#accion").val() == "N"){
                              registrar();
                         }else if ($("#accion").val() == "M"){
                              actualizar();
                         }
                    }
               }

               function cancelar(){
                    alertify.confirm("Confirmación", "¿Desea cancelar la carga de datos y limpiar los campos?",
                    function(){
                         if($("#accion").val() == "N"){
                              alertify.error("Operación cancelada. Se limpiaron los campos");
                              limpiarCampos();
                         }else if($("#accion").val() == "M"){
                              alertify.alert("Atención", "Operación cancelada",
                                   function(){
                                        window.location="empleados_lista.php";
                                   }
                              );
                         }

                    },
                    function(){
                         alertify.error("Puede continuar con la carga de datos");
                    }).set("labels", {ok:"SI", cancel:"NO"});
                    $("#ruc").focus();
               }



               function actualizar(){
                    var datos = $("#form_empleados").serialize();
                     //  alert(datos);
                     // return false;
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/EmpleadoServicios.php",
                         data: datos,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 4){
                              alertify.warning("El C.I. pertenece a otro Empleado. Cambie por otro");
                              $("#ci").focus();
                         }else if (resp == 5){
                              alertify.alert("Modificar", "Registro actualizado con éxito",
                                   function(){
                                        window.location="../forms/empleados_lista.php";
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
