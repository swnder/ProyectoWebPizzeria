<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">

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
     			$sql = "SELECT * FROM proveedor WHERE id = '$id'";
     			$res = mysqli_query($conex, $sql);
     			$reg = mysqli_fetch_array($res);
     		}
     	?>
          <div class="container gris">
               <h2 class="text-center mt-3" id="titulo"></h2>
               <div class="row" id="row">
                    <div class="col">
                         <!-- <form id="formulario" action="../servicios/clientesServicios.php" method="post"> -->
                         <!-- <form name="form_clientes" onsubmit="return false" action="return false"> -->
                         <form id="form_clientes">
                              <!-- PRIMERA FILA -->
                              <div class="form-group row mt-3" >
                                   <div class="col-12 col-md-6 mb-3">
                                        <label class="font-weight-bold" for="ruc">R.U.C.</label>
                                        <input type="text" class="form-control" name="ruc" id="ruc" placeholder="Ingrese R.U.C." onkeypress="return validarRuc(event)" maxlength="15" autofocus value="<?php echo isset($reg['ruc']) ? $reg['ruc'] : '';?>">
                                   </div>
                                   <div class="col-12 col-md-6">
                                        <label class="font-weight-bold" for="razon">RAZÓN SOCIAL</label>
                                        <input type="text" class="form-control text-uppercase" name="razon" id="razon" placeholder="Ingrese Razón Social" maxlength="50" value="<?php echo isset($reg['nombre']) ? $reg['nombre'] : '';?>">
                                   </div>

                              </div>

                              <!-- SEGUNDA FILA -->
                              <div class="form-group row">
                                   <div class="col-12 col-md-6">
                                        <label class="font-weight-bold" for="telefono">TELÉFONO</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese N° de teléfono" maxlength="10" value="<?php echo isset($reg['telefono']) ? $reg['telefono'] : '';?>">
                                   </div>
                                   <div class="col-12 col-md-6 mb-3">
                                        <label class="font-weight-bold" for="direccion">DIRECCIÓN</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingrese dirección" maxlength="50" value="<?php echo isset($reg['direccion']) ? $reg['direccion'] : '';?>">
                                   </div>

                              </div>

                              <!-- TERCERA FILA -->
                              <div class="form-group">
          					<label for="ciudad" class="col-sm-4 control-label">CIUDAD:</label>
          					<div class="col-sm-8">
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
     							<button type="button" class="btn gris btn-block" onclick="window.location.href='proveedor_lista.php';"><i class="fa fa-table"></i> Ir a lista de clientes</button>
     						</div>
     					</div>
                              <input type="hidden" name="accion" id="accion">
                              <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '';?>">
                              <input type="hidden" name="rucSinModif" id="rucSinModif" value="<?php echo isset($reg['ruc']) ? $reg['ruc'] : '';?>">
                              <input type="hidden" name="idCiu" id="idCiu" value="<?php echo isset($reg['ciudad']) ? $reg['ciudad'] : '';?>">
                         </form>
                    </div>
               </div>
          </div>

          <?php
               if (isset($_GET["accion"])){
                    if ($_GET["accion"] == "N"){
                         echo "<script>
                              document.getElementById('accion').value = 'N';
                              document.getElementById('titulo').innerHTML = 'ALTA DE PROVEEDOR';
                              document.title = 'Alta de proveedor';
                         </script>";
                    }else if ($_GET["accion"] == "M"){
                         echo "<script>
                              document.getElementById('accion').value = 'M';
                              document.getElementById('titulo').innerHTML = 'MODIFICAR PROVEEDOR';
                              document.title = 'Modificar proveedor';
                         </script>";
                    }
               }
          ?>
          <script>
               document.getElementById("idCiu").focus(); //Cuando es Modificar para que seleccione el Tipo de cliente
               function validarRuc(e){
                    tecla = (document.all) ? e.keyCode : e.which;
                    tecla = String.fromCharCode(tecla);
                    return /^[0-9\-]+$/.test(tecla);
               }

               function registrar(){

                    ruc = $("#ruc").val();
                    raz = $("#razon").val();
                    tel = $("#telefono").val();
                    dir = $("#direccion").val();
                    ciu= $("#idciudad").val();
                    acc = $("#accion").val();

                    $.ajax({

                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/proveedorServicios.php",

                         data: "ruc=" + ruc + "&razon=" + raz + "&telefono=" + tel + "&direccion=" + dir + "&idciudad=" + ciu +"&accion=" + acc,

                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 1){
                              alertify.warning("El R.U.C. ingresado ya existe. Cambie por otro");
                              $("#ruc").focus();
                         }else if (resp == 2){
                              alertify.success("Registro guardado con éxito");
                              limpiarCampos();
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }

               function limpiarCampos(){
                    $("#ruc").val("");
                    $("#razon").val("");
                    $("#direccion").val("");
                    $("#telefono").val("");
                    $("#ruc").focus();
               }

               function validarCampos(){
                    if ($("#ruc").val().length < 6){
                         alertify.error("Ingrese como mínimo 6 dígitos en R.U.C.");
                         $("#ruc").focus();
                    }else if ($("#razon").val().length < 5){
                         alertify.error("Ingrese como mínimo 5 caracteres en Razón Social");
                         $("#razon").focus();
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
                                        window.location="proveedor_lista.php";
                                   }
                              );
                         }

                    },
                    function(){
                         alertify.error("Puede continuar con la carga de datos");
                    }).set("labels", {ok:"SI", cancel:"NO"});
                    $("#ruc").focus();
               }

               function seleccionarTipoCliente(){
                    t = $("#idCiu").val();
                    if (t != ""){
                         sel = document.getElementById("idciudad");
                         for (var i = 0; i < sel.length; i++) {
                              if(sel[i].value == t){
                                   sel.selectedIndex = i;
                                   break;
                              }
                         }
                    }
               }

               function actualizar(){
                    ruc = $("#ruc").val();
                    raz = $("#razon").val();
                    tel = $("#telefono").val();
                    dir = $("#direccion").val();
                    ciu = $("#idciudad").val();
                    acc = $("#accion").val();
                    rsm = $("#rucSinModif").val();
                    id  = $("#id").val();
                    alertify.error("ruc:"+ruc);
                    alertify.error("nombre:"+raz);
                    alertify.error("telefono:"+tel);
                    alertify.error("direccion:"+dir);
                    alertify.error("ciudad:"+ciu);
                    alertify.error("rucsinmodiifcar:"+rsm);
                    alertify.error("#accion:"+acc);
                    alertify.error("#idproveedor:"+id);
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/proveedorServicios.php",
                         data: "ruc=" + ruc + "&razon=" + raz + "&telefono=" + tel + "&direccion=" + dir + "&idciudad=" + ciu +  "&accion=" + acc + "&rsm=" + rsm + "&id=" + id,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 3){
                              alertify.warning("El R.U.C. pertenece a otro proveedor. Cambie por otro");
                              $("#ruc").focus();
                         }else if (resp == 4){
                              alertify.alert("Modificar", "Registro actualizado con éxito",
                                   function(){
                                        window.location="../forms/proveedor_lista.php";
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
