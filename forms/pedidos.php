<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="../img/pizzeria.ico"/>
    <?php include "../plantilla/linktablas.php"; ?>
    <title>Pedidos</title>
  </head>
  <body onload="horaActual();">
      <div class="container gris">
           <h2 class="text-center mt-3  font-weight-bold" id="titulo">Hacer Pedidos</h2>
           <label class="font-weight-bold"><?php   date_default_timezone_set('America/Asuncion');
             $fecha=date("d-m-Y");
             $hora = date("H:i:s");
             // Hora: '.$hora';
             $hoy = $fecha. '<br>';
             echo "Fecha: ".$hoy;
             ?> </label><br>
             <label for="hora"   class="font-weight-bold">Hora:</label>
             <input id="hora" type="text" size="5"readonly>
           <div class="row" id="row">
                <div class="col">
                     <!-- <form id="formulario" action="../servicios/clientesServicios.php" method="post"> -->
                     <!-- <form name="form_clientes" onsubmit="return false" action="return false"> -->
                     <form id="form_pedidos" onkeypress="if(event.keyCode == 13){ event.returnValue=validarCampos();}">

                          <!-- PRIMERA FILA -->
                          <div class="form-group row mt-2">

                              <div class="col-12 col-sm-4 mt-3">
                                    <label for="vendedor" class="font-weight-bold">Mesero:</label>
                                    <select id="mesero" name="idmesero" class="form-control">
                                      <option value=""> ELIJA UN MESERO </option><hr>
                                      <?php
                                        require_once("../servicios/conexion.php");
                                        $con = conexion();
                                        $sql = "SELECT * FROM empleado where cargo='Mesero'";
                                        $res = mysqli_query($con, $sql);
                                          foreach ($res as $row) {
                                              echo "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
                                          }
                                      ?>
                                    </select>
                              </div>
                           <!-- cliente -->
                           <!-- <div class="col-12 col-sm-2 mt-3">

                           </div> -->
                            <div class="col-12 col-sm-4 mt-3">
                              <label for="idcliente" class="font-weight-bold">CLIENTE:</label>
                              <div class="input-group">

                                  <select id="cliente" name="idcliente" class="form-control custom-select">
                                    <option value=""> ELIJA UN CLIENTE</optin>
                                    <?php
                                      require_once("../servicios/conexion.php");
                                      $con = conexion();
                                      $sql = "SELECT * FROM cliente";
                                      $res = mysqli_query($con, $sql);
                                        foreach ($res as $row) {
                                            echo "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
                                        }
                                    ?>

                                  </select>
                                  <div class="input-group-append">
                                    <button type="button"  class="gris"name="button" onclick="cargarCliente();"><i class='fa fa-plus'></i></button>
                                  </div>
                            </div>


                           </div>

                           <div class="col-12 col-sm-2 mt-3">
                              <label class="font-weight-bold" for="mesa">Nro. Mesa</label>
                             <div class="input-group mb-3">
                               <input type="number" name="mesa" id="mesa" min="1" class="form-control ">
                               <div class="input-group-append">

                                 <button class="gris" type="button" data-toggle="modal" href="#elegirMesas"><i class='fa fa-plus'></i></button>
                               </div>
                              </div>




                           </div>
                           <div class="col-12 col-sm-2 mt-3">
                             <label class="font-weight-bold" for="personas">Cant/Per</label>
                             <input type="number" name="personas" id="personas" min="1" class="form-control ">
                           </div>

                          </div>

                          <!-- CUARTA FILA -->
          <div class="form-group row">
            <div class="col-12 col-md-4 mb-2">

              <button id="btnadd"class="btn gris btn-block font-weight-bold" type="button" data-toggle="modal" href="#myModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar</button>

            </div>
            <div class="col-12 col-md-4 mb-2">

              <button id="btneli"  onclick="vaciarTabla();" class="btn gris btn-block" type="button" ><i class="fa fa-trash-o font-weight-bold"> Borrar Tabla</i></button>

            </div>

            <div class="col-12 col-md-4 mb-2">
              <!-- <button class="btn btn-gris btn-block" type="button" onclick="validarCampos();"><i class="fa fa-plus" aria-hidden="true"></i> Pedir</button> -->
            </div>

          </div>
                <!-- table  -->
                <div class="table-responsive">
                     <table id="detalles" class="table table-hover">
                     <thead>
                       <tr class="bg gris">
                         <th>Opcion</th>
                         <th scope="col">Cantidad</th>
                         <th scope="col">Descripcion Producto</th>
                         <th scope="col">Codigo</th>
                         <th hidden>nombre</th>
                       </tr>

                     </thead>

                     <tbody class="bg text-white">

                     </tbody>
                   </table>

                </div>

                <button class="btn btn-gris btn-block mb-3 font-weight-bold" type="button" onclick="validarCampos();"><i class="fa fa-plus " aria-hidden="true"></i> Pedir</button>
                <!-- para guardar los detalles  -->
                 <input type="hidden" id="detalle" name="detalle"/>
                     </form>
                </div>
           </div>
      </div>
<!-- Modalpedidos -->
    <?php require_once "../plantilla/tablaPedidos.php"; ?>
<!--Modal Mesas-->
<div class="modal fade" id="elegirMesas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Selecione una Mesa</h4>

      </div>
      <div class="modal-body">
        <div class="container bg-dark " id="tabla">
                       <div class="table-responsive">
                         <!-- cabecera de la tabla -->
                          <h2 class="text-center mt-3">LISTA DE MESA</h2>
                            <table class="table table-bordered display nowrap stripe" id="tablaMesa" style="width:100%">
                                 <thead>
                                      <tr>
                                           <th hidden>ID</th>
                                           <th>ELEGIR</th>
                                           <th>DESCRIPCION</th>
                                           <th>UBICACIÓN</th>
                                           <th>SILLAS</th>
                                           <!-- <th>TELÉFONO</th> -->
                                           <!-- <th>MÓVIL</th> -->
                                           <!-- <th>TIPO CLIENTE</th> -->


                                      </tr>
                                 </thead>
                                 <tbody>
                                   <?php
                                        require_once("../servicios/conexion.php");
                                        $conex = conexion();
                                        // sentencia sql
                                        $sql = "SELECT * FROM mesa ORDER BY id";
                                        $rs = mysqli_query($conex, $sql);
                                        foreach ($rs as $fila) {
                                             echo "<tr>";
                                                  echo "<td hidden>".$fila['id']."</td>";
                                                  echo "<td class='text-center' style='cursor:pointer' onclick='obtenerIdEli()'><i class='fa fa-hand-pointer'>§</i></td>";
                                                  echo "<td>".$fila['descripcion']."</td>";
                                                  echo "<td>".$fila['ubicacion']."</td>";
                                                  echo "<td>".$fila['sillas']."</td>";
                                             echo "</tr>";
                                        }
                                        cerrarBD($conex);
                                   ?>
                                 </tbody>
                            </table>

                       </div>
                  </div>

                  <script>
                       $(document).ready(function() {
                            $('#tablaMesa').DataTable( {
                                 language: {
             					"emptyTable":			"No hay datos disponibles en la tabla.",
             					"info":		   		"Del _START_ al _END_ de _TOTAL_ ",
             					"infoEmpty":			"Mostrando 0 registros de un total de 0.",
             					"infoFiltered":		"(Filtrados de un total de _MAX_ registros)",
             					"infoPostFix":			"(actualizados)",
             					"lengthMenu":			"Mostrar _MENU_ registros",
             					"loadingRecords":		"Cargando...",
             					"processing":			"Procesando...",
             					"search":				"Buscar:",
             					"searchPlaceholder":	" Dato para buscar",
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
                  }, // fin de language
                    lengthMenu:				[[5, 10, 20, 50, -1], [5, 10, 20, 50, "Todos"]],
        				    // iDisplayLength:			5,
                                 //dom: 'lBf',
                                 dom: 'frtip'

                            } );
                       } );

                       function obtenerIdEli(){
                            //Capturar idCliente de la fila donde se hizo clic
                            var fi=0;
                            var id=0;
                            var tabla = document.getElementById("tablaMesa");
                            var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                            for (i=0; i<filas.length; i++) {
                                 filas[i].onclick = function() {
                                      //Obtener el id (columna oculta)
                                      fi = this.rowIndex;
                                      id = tabla.rows[fi].cells[0].innerHTML;
                                      document.getElementById("mesa").value = id;
                                 }
                            }
                            document.getElementById("cerrarMesa").click();
                       }


              </script>
      <div class="modal-footer">

        <button class="btn btn-default" type="button" id="cerrarMesa" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal -->
      <script >
        function cargarCliente(){
          alertify.confirm("Confirmación", "¿Desea Agregar un Cliente?",
          function(){
               window.location="clientes_am.php?accion=N&pedido=1";
          },
          function(){
               alertify.error("Puede continuar con la carga de datos");

          }).set("labels", {ok:"SI", cancel:"NO"});

        };
        function validarCampos(){
          mesa = $("#mesa").val();
          persona = $("#personas").val();
          cliente = $("#cliente").val();
          mesero = $("#mesero").val();
          if(mesero==""){
            alertify.error("El Elija un mesero");
            $("#mesero").focus();
          }else if(cliente==""){
            alertify.error("El Elija un Cliente");
            $("#cliente").focus();
          }else  if(mesa<0 || mesa==""){
            if(mesa<0 ){
              alertify.error("El campo no puede tener nuemeros negativos");
            }else{
              alertify.error("El campo no puede estar vacío");
            }
            $("#mesa").focus();
            return false;
          }else if(persona<0 || persona==""){
            if(persona<0 ){
              alertify.error("El campo no puede tener nuemeros negativos");
            }else{
              alertify.error("El campo no puede estar vacío");
            }
            $("#personas").focus();
            return false;
          }else if(valordetalle()<1){
            alertify.error("DEBE ELEGIR UN PRODUCTO AL MENOS");
            $("#btnadd").click();
            return false;
          }else{
            // cantidaddeProd();
            detalleArray();
            registrar();
            // alertify.success("Excelente, su pedido estará en breve, aguarde por favor!");
            vaciarCampos();
            return true;
          }

        };

        function vaciarCampos(){
           $("#mesa").val("");
           $("#personas").val("");
           $("#cliente").val("");
           $("#mesero").val("");
           $("#detalle").val("");
           $("tr[name=filas]").remove();
           $("input[name='pro[]']").remove();
           $("#mesero").focus();
        };

        function vaciarTabla(){
          alertify.confirm("Confirmación", "¿Desea Borrar Toda la Tabla?",
          function(){
            if(valordetalle()==0){
              alertify.warning("NO hay nada que Borrar");
            }else{
                $("tr[name=filas]").remove();
                $("input[name='pro[]']").remove();
                $("#detalle").val("");
                alertify.success("Tabla Borrada");
              };
          },
          function(){
                 alertify.error("Puede continuar con la carga de datos");
          }).set("labels", {ok:"SI", cancel:"NO"});

        };

        function valordetalle(){
          // devuelve si hay datos en la tabla detalle
          var ta = document.getElementById("detalles");
          var f = ta.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
          return f.length;

        }

        function registrar(){
          var datos=$("#form_pedidos").serialize();
            // alert(datos);
            // return false;
             $.ajax({
                  type: "POST",
                  dataType: 'html',
                  url: "../servicios/guardarPedidos.php",
                  //
                  // data: "ruc=" + ruc + "&razon=" + raz + "&telefono=" + tel + "&direccion=" + dir + "&idciudad=" + ciu +"&accion=" + acc,
                  data: datos,
             }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente

                   if (resp == 1){
                    alertify.success("Excelente, su pedido estará en breve, aguarde por favor!");
                  }else if (resp == 2){
                       alertify.error("La mesa ya esta ocupada");
                       $("#mesa").focus();
                  }
             }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                  alertify.error(resp);
                  
             });
        };


        function detalleArray() {
                      //Esta funcion pasa los datos del detalle a un array
                      var tabla = document.getElementById("detalles");
                      var canFilas = tabla.rows.length;
                      var array = new Array();
                      //Recorre las filas de la tabla
                      var pos=0;
                      //Pasar los valores de la tabla detalle a un Array
                      for(var i=1; i<canFilas; i++) {
                          cantidad = tabla.rows[i].cells[1].innerHTML;
                          cantidad= document.getElementById('cantidadProd').value;
                          array[pos] = cantidad;
                          pos = pos + 1;

                          codigo = tabla.rows[i].cells[3].innerHTML;
                          array[pos] = codigo;
                          pos = pos + 1;
                      }
                      //Convertir el array en String y almacenar en un campo oculto
                      document.getElementById("detalle").value=array.toString();
                  }

function horaActual(){

     f = new Date();
     h = f.getHours();
     m = f.getMinutes();
     s = f.getSeconds();
     if (h < 10){
          h = "0" + h;
     }
     if (m < 10){
          m = "0" + m;
     }
     if (s < 10){
          s = "0" + s;
     }
     h = h + ":" + m + ":" + s;
     document.getElementById("hora").value = h;
     setTimeout("horaActual()",1000);
};



      </script>

  </body>
</html>
