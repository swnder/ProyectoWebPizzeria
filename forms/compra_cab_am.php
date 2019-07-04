<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <link rel="icon" href="../img/pizzeria.ico"/>
          <?php require_once "../plantilla/linktablas.php"; ?>
          <?php
          //     if(!isset($_SESSION)){
          //          session_start();
          //      }
          //      if (!isset($_GET["accion"]) || !isset($_SESSION['nivelUsuario'])){
          //           header("Location: /BodegaPremium/denegado.php");
          //      }else {
          //
          //           if ($_SESSION['nivelUsuario'] == "VENTA") {
          //              header("Location:../menuvende.php");
          //            }else if($_SESSION['nivelUsuario']== "INVENTARIO"){
          //                header("Location:../menuinventa.php");
          //           }else {
          //                require_once("../menuadmin.php");
          //           }
          //      }
          //      if(!isset($_SESSION["caja"])){
          //           header("Location:../denegado.php");
          //      }
          //      if ($_GET['accion']=="N") {
          //           require_once("../servicios/conexion.php");
          // 		$conex = conexion();
          //           $sql = "SELECT MAX(Id_cabecera) maxi FROM compra_cabecera";
          //           $res = mysqli_query($conex, $sql);
     			// $reg = mysqli_fetch_array($res);
          //           $max=$reg['maxi'];
          //           if($max == null){
          //                $reg['Id_cabecera'] = 1;
          //           }else{
          //                $reg['Id_cabecera'] = $max+1;
          //           }
          //           $sql = "SELECT MAX(Numero_factura) maxN FROM compra_cabecera";
          //           $res = mysqli_query($conex, $sql);
     			// $reg = mysqli_fetch_array($res);
          //           $max2=$reg['maxN'];
          //           if($max2 == null){
          //                $reg['Numero_factura'] = 1;
          //           }else{
          //                $reg['Numero_factura'] = $max2+1;
          //           }
          //      }
          ?>
     </head>
     <body class="bg gris">

          <div class="container " >

               <form id="form_marcas">

               <div class="row" style="width:100%;margin:0; height:150px; position:absolute;color:white; background: rgba(221, 17, 17,0.80); top:0px;right:0;left:0;">
                    <i class="fa fa-money" style="position: absolute;top:5px; right:15%;color:white;"></i><label style="position: absolute;top:0; right:9%;color:white;"><?php
                         if(!isset($_SESSION)){
                              session_start();
                          }
                         if (isset($_SESSION['caja'])){
                              echo " CAJA N°: ".$_SESSION['caja'];
                         }
                    ?></label>
                    <div class="col">
                         <h2 class="text-center mt-3" id="titulo" style="color:white;"><b></b></h2>
                              <div class="form-group row mt-3">
                                   <div class="col-3 col-md-2">
                                        <label class="font-weight-bold" for="factura">N° Factura:</label>
                                        <input type="number" class="form-control" readonly name="factura" id="factura" value="<?php echo isset($reg['Numero_factura']) ? $reg['Numero_factura'] : '';?>" >
                                   </div>
                                   <div class="col-3 col-md-2">
                                        <label class="font-weight-bold" for="fecha">Fecha:</label>
                                        <input type="date" class="form-control" name="fecha" id="fecha"  autofocus>
                                   </div>
                                   <div class="col-3 col-md-3">
                                        <label class="font-weight-bold" for="ruc">R.U.C.(PROVEEDOR):</label>
                                        <!-- <input type="number" class="form-control" name="ruc" id="ruc" value="<?php echo isset($reg['Ruc']) ? $reg['Ruc'] : '';?>"> -->
                                        <input list="ruc" class="form-control"  id="iruc" onchange="buscarRuc();">
                                        <datalist name="ruc" id="ruc"  required>

                                             <?php
                                                 require_once("../servicios/conexion.php");
                                                 $conex = conexion();
                                                 $sql = "SELECT Ruc,Razon_social FROM proveedores";
                                                 $res = mysqli_query($conex, $sql);
                                                 while ($row = mysqli_fetch_array($res)) {
                                                   echo '  <option value="'.$row["Ruc"].'">'.$row["Razon_social"].'</option>';
                                                 }
                                             ?>
                                        </datalist>
                                   </div>
                                   <div class="col-3 col-md-3">
                                        <label class="font-weight-bold" for="razon">Razón Social:</label>
                                        <input type="text" class="form-control input-sm" name="razon" readonly id="razon" >
                                   </div>
                                   <div class="col-4 col-md-2">
                                        <label class="font-weight-bold" for="condicion">Condición:</label><br>
                                        <input type="radio" id="contado" name="condicion" value="CONTADO">
                                       <label class="font-weight-bold" for="contado">Contado</label>

                                       <input type="radio" id="credito" name="condicion" value="CRÉDITO">
                                       <label class="font-weight-bold" for="credito">Crédito</label>
                                   </div>
                                   <!-- <div class="col-4 col-md-2">
                                        <label class="font-weight-bold" for="estado">Estado:</label><br>
                                        <input type="radio" id="activo" name="estado" value="ACTIVO">
                                       <label class="font-weight-bold" for="activo">Activo</label>

                                       <input type="radio" id="anulado" name="estado" value="ANULADO">
                                       <label class="font-weight-bold" for="credito">Anulado</label>
                                   </div> -->

                              </div>
                    </div>
               </div>
               <div class="row" style="width:100%; height:80px; position:absolute; margin:0;bottom: 0px;right:0;left:0;background: rgba(221, 17, 17,0.80);color:white;">
                    <div class="col">
                         <div class="form-group row" style="margin:0;" >
                              <div class="col-6 col-md-3" >
                                   <label class="font-weight-bold" for="iva">TOTAL IVA 5%:</label>
                                   <input type="number" class="form-control" name="iva5" style="font-family:Tahoma;font-size:40px;font-weight:bold;text-align:right" readonly id="iva5">
                              </div>
                              <div class="col-6 col-md-3" >
                                   <label class="font-weight-bold" for="iva">TOTAL IVA 10%:</label>
                                   <input type="number" class="form-control" name="iva10" style="font-family:Tahoma;font-size:40px;font-weight:bold;text-align:right" readonly id="iva10">
                              </div>
                              <div class="col-6 col-md-3" >
                                   <label class="font-weight-bold" for="totaliva">TOTAL IVA:</label>
                                   <input type="number" class="form-control" name="totaliva" style="font-family:Tahoma;font-size:40px;font-weight:bold;text-align:right" readonly id="totaliva">
                              </div>
                              <div class="col-6 col-md-3">
                                   <label class="font-weight-bold" for="total">TOTAL:</label>
                                   <input type="number" class="form-control" name="total" style="font-family:Tahoma;font-size:40px;font-weight:bold;text-align:right" readonly id="total" >
                              </div>
                         </div>
                    </div>
               </div>
               <div  class="" style="width:90%; height:100px; position:fixed;background: rgba(241, 238,  238, 0.60); top:155px;left:5%;">
                    <div class="row">
                         <div class="col">
                              <div class="from-group row">
                                   <div class="col-3 col-md-2">
                                        <label class="font-weight-bold" for="cod">Cód. Barra:</label>
                                        <input list="cod" class="form-control" id="icod" onchange="buscarCod();">
                                        <datalist name="cod" id="cod"  required>
                                             <?php
                                                 require_once("../servicios/conexion.php");
                                                 $conex = conexion();
                                                 $sql = "SELECT Id_articulo,Articulo FROM articulos";
                                                 $res = mysqli_query($conex, $sql);
                                                 while ($row = mysqli_fetch_array($res)) {
                                                   echo '  <option value="'.$row["Id_articulo"].'">'.$row["Articulo"].'</option>';
                                                 }
                                             ?>
                                        </datalist>
                                   </div>
                                   <div class="col-3 col-md-2">
                                        <label class="font-weight-bold" for="articulo">Artículo:</label>
                                        <input type="text" class="form-control input-sm text-uppercase" readonly name="articulo"  id="articulo">
                                   </div>
                                   <div class="col-3 col-md-2">
                                        <label class="font-weight-bold" for="precio">Precio Unitario:</label>
                                        <input type="number" class="form-control input-sm" name="precio"  id="precio">
                                   </div>
                                   <div class="col-3 col-md-2">
                                        <label class="font-weight-bold" for="iva">I.V.A.:</label>
                                        <select class="form-control" name="iva" id="iva" disabled>
                                           <option value=""></option>
                                           <option value="0">Exenta</option>
                                           <option value="5">5%</option>
                                           <option value="10">10%</option>
                                        </select>
                                   </div>
                                   <div class="col-3 col-md-2">
                                        <label class="font-weight-bold" for="cantidad">Cantidad:</label>
                                        <input type="number" class="form-control input-sm" name="cantidad"  id="cantidad">
                                   </div>
                                   <div class="col-2 col-md-1">
                                        <br>
                                        <button type="button" class="btn btn-success" onclick="agregar();">Agregar
                                         </button>
                                    </div>
                              </div>
                         </div>
                    </div>

               </div>
               <div  class="table-responsive" style="width:90%; height:240px; position:relative; top:260px;left:5%">
                    <table class="table table-bordered display nowrap stripe" id="tablaDetalle" style="width:100%;height:240px;">
                         <thead>
                              <tr>
                                   <th rowspan="2"  style="vertical-align: middle;">ACCION</th>
                                   <th rowspan="2"  style="vertical-align: middle;">CÓD. DE BARRA</th>
                                   <th rowspan="2" style="vertical-align: middle;" class="text-center">ARTICULO</th>
                                   <th rowspan="2" style="vertical-align: middle;">CANTIDAD</th>
                                   <th colspan="3" class="text-center">PRECIO UNITARIO</th>
                                   <th rowspan="2" style="vertical-align: middle;">SUBTOTAL</th>
                                   <th rowspan="2" style="vertical-align: middle;">QUITAR</th>
                              </tr>
                              <tr>
                                   <th>EXENTA</th>
                                   <th>IVA 5%</th>
                                   <th>IVA 10%</th>
                              </tr>
                         </thead>
                         <tbody>
                         </tbody>
                    </table>
               </div>
               <div class="" style="width:90%; height:80px; position:fixed;top:510px;left:5%;">
                    <div class="row" >
                         <div class="col">
                              <div class="form-group row">
     						<div class="col-12 col-md-4 mb-2">
     							<button class="btn btn-success btn-block" type="button" onclick="validarCampos();"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
     						</div>

     						<div class="col-12 col-md-4 mb-2">
     							<button class="btn btn-danger btn-block" type="button" onclick="cancelar();"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
     						</div>

     						<div class="col-12 col-md-4 mb-2">
     							<button type="button" class="btn btn-primary btn-block" onclick="window.location.href='compra_cab_lista.php'"><i class="fa fa-table"></i> Ir a lista de Compras cabecera</button>
     						</div>
     					</div>
                         </div>
                    </div>
               </div>



               <input type="text" name="accion" id="accion">
               <!-- <input type="hidden" class="form-control" name="cabecera" readonly id="cabecera" value="<?php echo isset($reg['Id_cabecera']) ? $reg['Id_cabecera'] : '';?>"> -->
               <!-- <input type="hidden" name="id" id="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '';?>"> -->
               <!-- <input type="hidden" name="marcaSinModif" id="marcaSinModif" value="<?php echo isset($reg['Marca']) ? $reg['Marca'] : '';?>"> -->
          </form>

          </div>

          <script>
               //document.getElementById('accion').value = 'N';
               document.getElementById('titulo').innerHTML = 'COMPRAS';
               document.title = 'Compras';
               document.getElementById("iva5").value =0;
               document.getElementById("iva10").value = 0;
               document.getElementById("totaliva").value =0;
               document.getElementById("total").value = 0;
               document.getElementsByName('condicion')[0].checked = true;
               $(document).ready(function() {
                    $('#tablaDetalle').DataTable( {
                         //scrollX: true,
                         "scrollY":"200px",//para que aparezca la barra
                         //scrollCollapse: true,
                         //fixedColumns:true,
                         paging:false,
                         autoWidth:  false,
                         columnDefs:[//para ajustar tamaño del dataTables
                            {"width":"10%", "targets":[0,2,3,4,5]},
                            {"width":"50%", "targets":[1]}
                         ],
                         language: {
                   					"emptyTable":			"No hay datos disponibles en la tabla.",
                   					"info":		   		"Del _START_ al _END_ de _TOTAL_ ",
                   					"infoEmpty":			"Mostrando 0 registros de un total de 0.",
                   					"infoFiltered":		"(Filtrados de un total de _MAX_ registros)",
                   					"infoPostFix":			"(actualizados)",
                   					"lengthMenu":			"Mostrar _MENU_ registro&nbsp&nbsp&nbsp",
                   					"loadingRecords":		"Cargando...",
                   					"processing":			"Procesando...",
                   					"search":				"Buscar:",
                   					"searchPlaceholder":	"Dato para buscar",
                   					"zeroRecords":			"No se han encontrado coincidencias.",
                   					"paginate": {
                   						"first":			"Primera",
                   						"last":			"Última",
                   						"next":			"Siguiente",
                   						"previous":		"Anterior"
                   					},
                   					"aria": {
                   						"sortAscending":	"Ordenación ascendente",
                   						"sortDescending":	"Ordenación descendente"
                   					}
                   				},
				     iDisplayLength:			5,
                         dom: 'l'
                         //dom: 'Blfrtip',
                    } );
               } );
               function buscarRuc(){
                 ruc = $("#iruc").val();
                 $.ajax({
                      type: "POST",
                      dataType: 'html',
                      url: "../servicios/busqueda.php",
                      data: "criterio=Ruc&valor=" + ruc+"&tabla=proveedores&busqueda=Razon_social",
                 }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriament
                      document.getElementById("razon").value=resp;
                      $("#icod").focus();
                 }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                      alertify.error(resp);
                 });
               }
               function buscarCod(){
                    $("#articulo").val("");
                    $("#precio").val("");
                    document.getElementById("iva").selectedIndex=0;
                    $("#cantidad").val("");
                 cod = $("#icod").val();
                 $.ajax({
                      type: "POST",
                      dataType: 'html',
                      url: "../servicios/busqueda.php",
                      data: "criterio=Id_articulo&valor=" +cod+"&tabla=articulos&busqueda=Articulo",
                 }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriament
                      if(resp==""){
                           document.getElementById('articulo').readOnly = false;
                           document.getElementById('iva').disabled = false;
                           $("#articulo").focus();
                           document.getElementById('accion').value = 'N';
                      }else{
                           document.getElementById('articulo').readOnly = true;
                           document.getElementById('iva').disabled = true;
                           document.getElementById("articulo").value=resp;
                           buscarPre();
                           document.getElementById('accion').value = 'M';
                      }
                 }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                      alertify.error(resp);
                 });
               }
               function buscarPre(){
                    cod = $("#icod").val();
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/busqueda.php",
                         data: "criterio=Id_articulo&valor=" +cod+"&tabla=articulos&busqueda=Precio_unidad",
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriament
                         document.getElementById("precio").value=resp;
                         $("#precio").focus();
                         buscarIva();
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }
               function buscarIva(){
                    cod = $("#icod").val();
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/busqueda.php",
                         data: "criterio=Id_articulo&valor=" +cod+"&tabla=articulos&busqueda=IVA",
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriament
                         if(resp==0){
                              document.getElementById("iva").selectedIndex=1;
                         }else{
                              if (resp == 5) {
                                   document.getElementById("iva").selectedIndex=2;
                              }else {
                                   document.getElementById("iva").selectedIndex=3;
                              }

                         }
                         $("#cantidad").focus();
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }
               document.getElementById("menu").style.display="none";//oculto porque no debe permitir salirse de la pantalla
               function agregar(){
                    if($("#icod").val() == ""){
                         alertify.error("Ingrese o Seleccione un Código de Barra");
                         $("#icod").focus();
                    }else if ($("#articulo").val() == "") {
                         alertify.error("Ingrese Artículo");
                         $("#articulo").focus();
                    }else if ($("#precio").val() < 1000) {
                         alertify.error("Ingrese precio superior a 1000");
                         $("#precio").focus();
                    }else if ($("#iva").val() == "") {
                         alertify.error("Seleccione I.V.A.");
                         $("#iva").focus();
                    }else if ($("#cantidad").val() < 1) {
                         alertify.error("Ingrese Cantidad Válida");
                         $("#cantidad").focus();
                    }else{
                         var acc = $("#accion").val();
                         var cod = $("#icod").val();
                         var art = $("#articulo").val();
                         var can = $("#cantidad").val();
                         var pre = $("#precio").val();
                         var iva = $("#iva").val();
                         var exe =0;
                         var iv5 =0;
                         var iv1 =0;
                         cantidad = parseInt(can,10);
                         precio = parseInt(pre,10);
                         var valor = cantidad*precio;
                         //alert(valor);
                         if(iva == 0){
                              exe  = precio;
                              iv5 =0;
                              iv1 =0;
                         }else if(iva == 5){
                              exe = 0;
                              iv5=precio;
                              iv1=0;
                         }else{
                              exe = 0;
                              iv5=0;
                              iv1=precio;
                         }
                         //alert("h");
                         if(iva!=0){
                              ti = parseInt($("#totaliva").val(),10);
                              if(iva==5){
                                   t5 = parseInt($("#iva5").val(),10);
                                   document.getElementById("iva5").value = t5 +Math.round(valor/21);
                                   v1 = parseInt(Math.round(valor/21));
                                   document.getElementById("totaliva").value = (ti +v1);
                              }else if (iva == 10) {
                                   t10 = parseInt($("#iva10").val(),10);
                                   document.getElementById("iva10").value= t10+Math.round(valor/11);
                                   v2 = Math.round(valor/11);
                                   document.getElementById("totaliva").value = (ti +v2);
                              }
                         }
                         tt = parseInt($("#total").val(),10);
                         document.getElementById("total").value= (tt + valor);
                         var t = $('#tablaDetalle').DataTable();
                         i = '<td class="text-center" aling="center"><i class="fa fa-trash-o" style="cursor:pointer" onclick="pregunta(this)"></i></td>';
                         t.row.add([acc,cod,art,can,exe,iv5,iv1,valor,i]).draw(false);
                         $("#articulo").val("");
                         $("#icod").val("");
                         $("#precio").val("");
                         document.getElementById("iva").selectedIndex=0;
                         $("#cantidad").val("");
                         $("#icod").focus();
                    }
               }
               function pregunta(bot){
                    alertify.confirm().set("labels", {ok:"SI", cancel:"NO"});
                    alertify.confirm().set("defaultFocus", "cancel");
                    alertify.dialog("confirm").set({transition:"flipx"});
                    alertify.confirm("Quitar Artículo", "¿Desea quitar el registro del detalle?",
                         function(){ //SI
                              quitar(bot);
                         },
                         function(){ //NO
                              alertify.error("Operación cancelada");
                              $("#icod").focus();
                         }
                    );
               }
               function quitar(bot){
                    //alert("fffff");
                    var t = $("#tablaDetalle").DataTable();
                    data = t.row($(bot).parents('tr')).data();
                    //alert(data[0]);
                    tv = parseInt(data[7]);
                    ti = parseInt($("#totaliva").val(),10);
                    tt = parseInt($("#total").val());
                    if(data[4]==0){
                         if(data[5]!=0){
                              ti = ti - Math.round(tv/21);
                              tt = tt - tv;
                              document.getElementById("iva5").value -= Math.round(tv/21);
                              document.getElementById("totaliva").value = ti;
                         }else{
                              ti = ti - Math.round(tv/11);
                              tt = tt - tv;
                              document.getElementById("iva10").value -= Math.round(tv/11);
                              document.getElementById("totaliva").value = ti;
                         }
                    }else{
                         tt = tt - tv;
                    }
                    document.getElementById("total").value = tt;
                    t.row($(bot).parents('tr')).remove().draw();

               }

               function limpiarCampos(){
                    $("#fecha").val("");
                    $("#iruc").val("");
                    $("#razon").val("");
                    var table = $('#tablaDetalle').DataTable();
                    table.clear().draw();
                    document.getElementsByName('condicion')[0].checked = true;
                    document.getElementById("iva5").value=0;
                    document.getElementById("iva10").value=0;
                    document.getElementById("totaliva").value=0;
                    document.getElementById("total").value=0;
                    $("#fecha").focus();
               }

               function validarCampos(){
                    // var tabla = document.getElementById("tablaDetalle");
                    // var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    var table = $('#tablaDetalle').DataTable();
                    var can = table.page.info().recordsTotal
                    if($("#fecha").val() == ""){
                         alertify.error("Seleccione Fecha!!");
                         $("#fecha").focus();
                    }else if($("#iruc").val() == "" || $("#razon").val()==""){
                         alertify.error("Seleccione Ruc!!");
                         $("#iruc").focus();
                         alert(can);
                    }else if(can < 1){
                         alertify.error("Debe registrar mínimo un artículo!!");
                         $("#icod").focus();
                    }else{
                         alert("holi");
                         limpiarCampos();
                         // if ($("#accion").val() == "N"){
                         //      //registrar();
                         // }else if ($("#accion").val() == "M"){
                         //      actualizar();
                         // }
                    }
                    //alert("holi");
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
                                        window.location="compra_cab_lista.php";
                                   }
                              );
                         }

                    },
                    function(){
                         alertify.error("Puede continuar con la carga de datos");
                    }).set("labels", {ok:"SI", cancel:"NO"});
                    $("#factura").focus();
               }

          </script>
     </body>
</html>
