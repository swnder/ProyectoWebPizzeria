<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
        <link rel="icon" href="../img/pizzeria.ico"/>
        <?php  require_once "../plantilla/linktablas.php"; ?>
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
     			$sql = "SELECT * FROM producto WHERE id = '$id'";
     			$res = mysqli_query($conex, $sql);
     			$reg = mysqli_fetch_array($res);
     		}
     	?>
      <!-- cabecera -->

          <div class="container gris">
               <h2 class="text-center mt-3" id="titulo"></h2>
               <div  id="row"class="row">
                    <div class="col" >
                         <!-- <form id="formulario" action="../servicios/clientesServicios.php" method="post"> -->
                         <!-- <form name="form_clientes" onsubmit="return false" action="return false"> -->
                         <form id="form_clientes" onkeypress="if(event.keyCode == 13) event.returnValue =validarCampos();">
                              <!-- PRIMERA FILA -->
                              <div class="form-group row mt-3" >
                                   <div class="col-12 col-md-4">
                                   <label class="font-weight-bold" for="nombre">NOMBRE</label>
                                   <input type="text" class="form-control text-uppercase" name="nombre" id="nombre" placeholder="Ingrese Nombre" maxlength="50" value="<?php echo isset($reg['nombre']) ? $reg['nombre'] : '';?>">
                              </div>

          					<div class="col-12 col-sm-4">
                      <label for="categoria" class="col-sm-4 control-label">CATEGORIA:</label>
          						<select id="idcategoria" name="idcategoria" class="form-control">
          							<?php
          								require_once("../servicios/conexion.php");
          								$con = conexion();
          								$sql = "SELECT * FROM categoria";
          								$res = mysqli_query($con, $sql);
          		                        foreach ($res as $row) {
          		                            echo "<option value='".$row["id"]."'>".$row["categoria"]."</option>";
          		                        }
          							?>
          						</select>
          					</div>
                    <div class="col-12 col-sm-4">
                                        <label for="marca" class="col-sm-4 control-label">MARCA:</label>
                      <select id="idmarca" name="idmarca" class="form-control">
                        <?php
                          require_once("../servicios/conexion.php");
                          $con = conexion();
                          $sql = "SELECT * FROM marca";
                          $res = mysqli_query($con, $sql);
                                      foreach ($res as $row) {
                                          echo "<option value='".$row["id"]."'>".$row["marca"]."</option>";
                                      }
                        ?>
                      </select>
                    </div>

                              </div>

                              <!-- SEGUNDA FILA -->
                              <div class="form-group row">

                                   <div class="col-12 col-md-4 mb-3">
                                        <label class="font-weight-bold" for="precio">PRECIO</label>
                                        <input type="text" class="form-control" name="precio" id="precio" placeholder="Ingrese Precio" maxlength="50" value="<?php echo isset($reg['precio']) ? $reg['precio'] : '';?>">
                                   </div>


                                   <div class="col-12 col-sm-4 mb-3">
                                      <label for="tamano" class="col-sm-4 control-label">TAMANO:</label>
                                     <select id="idtamano" name="idtamano" class="form-control">
                                       <?php
                                         require_once("../servicios/conexion.php");
                                         $con = conexion();
                                         $sql = "SELECT * FROM tamano";
                                         $res = mysqli_query($con, $sql);
                                                     foreach ($res as $row) {
                                                         echo "<option value='".$row["id"]."'>".$row["tamano"]."</option>";
                                                     }
                                       ?>
                                     </select>
                                   </div>
                                   <div class="col-12 col-md-4 mb-3">
                                        <label class="font-weight-bold" for="stock">STOCK</label>
                                        <input type="text" class="form-control" name="stock" id="stock" placeholder="Ingrese Stock" maxlength="50" value="<?php echo isset($reg['stock']) ? $reg['stock'] : '';?>">
                                   </div>
                              </div>

                              <!-- TERCERA FILA -->
                              <div class="form-group">


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
     							<button type="button" class="btn gris btn-block" onclick="window.location.href='producto_lista.php';"><i class="fa fa-table"></i> Ir a lista de Producto</button>
     						</div>
     					</div>
                              <input type="hidden" name="accion" id="accion">
                              <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '';?>">
                              <input type="hidden" name="rucSinModif" id="rucSinModif" value="<?php echo isset($reg['nombre']) ? $reg['nombre'] : '';?>">
                              <input type="hidden" name="idcat" id="idcat" value="<?php echo isset($reg['categoria']) ? $reg['categoria'] : '';?>">
                              <input type="hidden" name="idmar" id="idmar" value="<?php echo isset($reg['marca']) ? $reg['marca'] : '';?>">
                              <input type="hidden" name="idtam" id="idtam" value="<?php echo isset($reg['tamano']) ? $reg['tamano'] : '';?>">
                         </form>
                    </div>
               </div>
          </div>

          <?php
               if (isset($_GET["accion"])){
                    if ($_GET["accion"] == "N"){
                         echo "<script>
                              document.getElementById('accion').value = 'N';
                              document.getElementById('titulo').innerHTML = 'ALTA DE PRODUCTO';
                              document.title = 'Alta de producto';
                         </script>";
                    }else if ($_GET["accion"] == "M"){
                         echo "<script>
                              document.getElementById('accion').value = 'M';
                              document.getElementById('titulo').innerHTML = 'MODIFICAR PRODUCTO';
                              document.title = 'Modificar producto';
                         </script>";
                    }
               }
          ?>
          <script>
               document.getElementById("idcat").focus(); //Cuando es Modificar para que seleccione el Tipo de cliente
               function validarRuc(e){
                    tecla = (document.all) ? e.keyCode : e.which;
                    tecla = String.fromCharCode(tecla);
                    return /^[0-9\-]+$/.test(tecla);
               }

               document.getElementById("idmar").focus(); //Cuando es Modificar para que seleccione el Tipo de cliente
               function validarRuc(e){
                    tecla = (document.all) ? e.keyCode : e.which;
                    tecla = String.fromCharCode(tecla);
                    return /^[0-9\-]+$/.test(tecla);
               }

               document.getElementById("idtam").focus(); //Cuando es Modificar para que seleccione el Tipo de cliente
               function validarRuc(e){
                    tecla = (document.all) ? e.keyCode : e.which;
                    tecla = String.fromCharCode(tecla);
                    return /^[0-9\-]+$/.test(tecla);
               }

               function registrar(){

                    nombre= $("#nombre").val();
                    idcategoria= $("#idcategoria").val();
                    idmarca = $("#idmarca").val();
                    precio = $("#precio").val();
                    idtamano= $("#idtamano").val();
                    stock= $("#stock").val();
                    acc = $("#accion").val();

                    $.ajax({

                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/productoServicios.php",
                         data: "nombre=" + nombre + "&idcategoria=" + idcategoria + "&idmarca=" + idmarca + "&precio=" + precio + "&idtamano=" + idtamano + "&stock=" + stock +"&accion=" + acc,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 1){
                              alertify.warning("El nombre ingresado ya existe. Cambie por otro");
                              $("#nombre").focus();
                         }else if (resp == 2){
                              alertify.success("Registro guardado con éxito");
                              limpiarCampos();
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }

               function limpiarCampos(){
                    $("#nombre").val("");
                    $("#precio").val("");
                    $("#stock").val("");
                    $("#nombre").focus();
               }

               function validarCampos(){
                    if ($("#nombre").val().length < 4){
                         alertify.error("Ingrese como mínimo 6 dígitos en Nombre");
                         $("#nombre").focus();
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
                                        window.location="producto_lista.php";
                                   }
                              );
                         }

                    },
                    function(){
                         alertify.error("Puede continuar con la carga de datos");
                    }).set("labels", {ok:"SI", cancel:"NO"});
                    $("#nombre").focus();
               }

               function seleccionarTipoCategoria(){
                    t = $("#idcat").val();
                    if (t != ""){
                         sel = document.getElementById("idcategoria");
                         for (var i = 0; i < sel.length; i++) {
                              if(sel[i].value == t){
                                   sel.selectedIndex = i;
                                   break;
                              }
                         }
                    }
               }
               function seleccionarTipoMarca(){
                    t = $("#idmar").val();
                    if (t != ""){
                         sel = document.getElementById("idmarca");
                         for (var i = 0; i < sel.length; i++) {
                              if(sel[i].value == t){
                                   sel.selectedIndex = i;
                                   break;
                              }
                         }
                    }
               }
               function seleccionarTipoCliente(){
                    t = $("#idtam").val();
                    if (t != ""){
                         sel = document.getElementById("idtamano");
                         for (var i = 0; i < sel.length; i++) {
                              if(sel[i].value == t){
                                   sel.selectedIndex = i;
                                   break;
                              }
                         }
                    }
               }

               function actualizar(){
                    nombre= $("#nombre").val();
                    idcategoria= $("#idcategoria").val();
                    idmarca= $("#idmarca").val();
                    precio= $("#precio").val();
                    idtamano= $("#idtamano").val();
                    stock= $("#stock").val();
                    acc = $("#accion").val();
                    rsm = $("#rucSinModif").val();
                    id  = $("#id").val();



                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/productoServicios.php",
                         data: "nombre=" + nombre + "&idcategoria=" + idcategoria + "&idmarca=" + idmarca + "&precio=" + precio + "&idtamano=" + idtamano + "&stock=" + stock +  "&accion=" + acc + "&rsm=" + rsm + "&id=" + id,
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 3){
                              alertify.warning("El nombre pertenece a otro producto. Cambie por otro");
                              $("#nombre").focus();
                         }else if (resp == 4){
                              alertify.alert("Modificar", "Registro actualizado con éxito",
                                   function(){
                                        window.location="../forms/producto_lista.php";
                                   }
                              );
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }
               seleccionarTipoCategoria()
               seleccionarTipoMarca()
               seleccionarTipoCliente();

          </script>
     </body>
</html>
