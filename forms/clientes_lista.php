<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <title>Clientes</title>
          <link rel="icon" href="../img/clientes.png"/>

          <?php require_once "../plantilla/linktablas.php"; ?>

     </head>
      <!-- cabecera -->
    <?php  require_once "../plantilla/cabecera.php";?>
     <body >

          <div class="container mt-5" id="tabla">
               <div class="table-responsive">
                    <h2 class="text-center mt-3">LISTA DE CLIENTES</h2>
                    <table class="table table-bordered display nowrap stripe" id="tablaClientes" style="width:100%">
                         <thead>
                              <tr>
                                   <th hidden>ID</th>
                                   <th>R.U.C.</th>
                                   <th>NOMBRE</th>
                                   <th>TELÉFONO</th>
                                   <th>DIRECCION</th>
                                   <th>EMAIL</th>
                                   <th>CIUDAD</th>
                                   <th>MODIFICAR</th>
                                   <th>ELIMINAR</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                                   require_once("../servicios/conexion.php");
                                   $conex = conexion();
                                   $sql ="SELECT cl.id,cl.ruc,cl.nombre,cl.telefono,cl.direccion,cl.email,c.ciudad FROM cliente cl JOIN ciudad c ON cl.ciudad=c.id ";
                                   $rs = mysqli_query($conex, $sql);
                                   foreach($rs as $fila){
                                        echo "<tr>";
                                             echo "<td hidden>".$fila['id']."</td>";
                                             echo "<td>".$fila['ruc']."</td>";
                                             echo "<td>".$fila['nombre']."</td>";
                                             echo "<td>".$fila['telefono']."</td>";
                                             echo "<td>".$fila['direccion']."</td>";
                                             echo "<td>".$fila['email']."</td>";
                                             echo "<td>".$fila['ciudad']."</td>";
                                             echo "<td class='text-center' style='cursor:pointer' onclick='obtenerIdModi()'><i class='fa fa-pencil'></i></td>";
                                             echo "<td class='text-center' style='cursor:pointer' onclick='obtenerIdEli()'><i class='fa fa-trash-o'></i></td>";
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
                    $('#tablaClientes').DataTable( {
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
                         lengthMenu:				[[5, 10, 20, 50, -1], [5, 10, 20, 50, "Todos"]],
				     iDisplayLength:			5,
                         //dom: 'lBf',
                         dom: 'Bfrtip',
                         buttons: [
                              'copyHtml5',
                              'excelHtml5',
                              'csvHtml5',
                              'pdfHtml5',
                              'print',
                              {className:"btn gris",text: 'Nuevo', action: function (e, dt, node, config){
                     		     window.location="clientes_am.php?accion=N";
                      		}}
                         ]
                    } );
               } );

               function obtenerIdEli(){
                    //Capturar idCliente de la fila donde se hizo clic
                    var fi=0;
                    var id=0;
                    var tabla = document.getElementById("tablaClientes");
                    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    for (i=0; i<filas.length; i++) {
                         filas[i].onclick = function() {
                              //Obtener el id (columna oculta)
                              fi = this.rowIndex;
                              id = tabla.rows[fi].cells[0].innerHTML;
                         }
                    }
                    alertify.confirm().set("labels", {ok:"SI", cancel:"NO"});
                    alertify.confirm().set("defaultFocus", "cancel");
                    alertify.dialog("confirm").set({transition:"flipx"});
                    alertify.confirm("Eliminar registro", "¿Desea eliminar el registro del Cliente?",
                         function(){ //SI
                              eliminar(id);
                         },
                         function(){ //NO
                              alertify.error("Operación cancelada");
                         }
                    );
               }

               function eliminar(id){
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/clientesServicios.php",
                         data: "id=" + id + "&accion=E",
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 5){
                              alertify.alert("Atención", "El registro del cliente fue Eliminado",
                                   function(){
                                        location.reload();
                                   }
                              );
                         }
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }

               function obtenerIdModi(){
                    var fi=0;
                    var id=0;
                    var tabla = document.getElementById("tablaClientes");
                    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    for (i=0; i<filas.length; i++) {
                         filas[i].onclick = function() {
                              //Obtener el id (columna oculta)
                              fi = this.rowIndex;
                              id = tabla.rows[fi].cells[0].innerHTML;
                              window.location="clientes_am.php?accion=M&id="+id;
                         }
                    }
               }
          </script>
     </body>
</html>
