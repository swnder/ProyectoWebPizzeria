<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <link rel="icon" href="../img/pizzeria.ico"/>
          <title>EMPLEADOS</title>
          <?php require_once "../plantilla/linktablas.php";?>
     </head>
     <body >
       <?php require_once "../plantilla/CabecerasSegunNivel.php"; ?>
         <div class="container mt-5" id="tabla" >
               <div class="table-responsive " >
                    <h2 class="text-center mt-3">EMPLEADOS</h2>
                    <table class="table table-bordered display nowrap stripe " id="tablaproveedor" style="width:100%">
                         <thead>
                              <tr>
                                   <th hidden>ID</th>
                                   <th>USUARIO</th>
                                   <!-- <th>FOTO</th> -->
                                   <th> C.I.</th>
                                   <th>NOMBRE y APELLIDO</th>
                                   <th>FECHA DE NAC.</th>
                                   <th>NACIONALIDAD</th>
                                   <th>CIUDAD</th>
                                   <th>BARRIO</th>
                                   <th>TELEFONO</th>
                                   <th>CARGO</th>
                                   <th>DIRECCION</th>
                                   <th>MODIFICAR</th>
                                   <th>ELIMINAR</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                                   require_once("../servicios/conexion.php");
                                   $conex = conexion();
                                   $sql = "SELECT e.id, u.usuario, e.ci, CONCAT(e.nombre,' ', e.apellido) as nombreyapellido, e.fechanaci,e.nacionalidad, c.ciudad, e.barrio,e.telefono, e.cargo,e.telefono,e.cargo,e.direccion
                                   FROM empleado e
                                   INNER JOIN usuario u ON u.id = e.usuario
                                   INNER JOIN ciudad c ON c.id = e.ciudad";
                                   $rs = mysqli_query($conex, $sql);
                                   foreach ($rs as $fila) {
                                        echo "<tr>";
                                             echo "<td hidden>".$fila['id']."</td>";
                                             echo "<td>".$fila['usuario']."</td>";
                                             // echo "<td>".$fila['foto']."</td>";
                                             echo "<td>".$fila['ci']."</td>";
                                             echo "<td>".$fila['nombreyapellido']."</td>";
                                             echo "<td>".$fila['fechanaci']."</td>";
                                             echo "<td>".$fila['nacionalidad']."</td>";
                                             echo "<td>".$fila['ciudad']."</td>";
                                             echo "<td>".$fila['barrio']."</td>";
                                             echo "<td>".$fila['telefono']."</td>";
                                             echo "<td>".$fila['cargo']."</td>";
                                             echo "<td>".$fila['direccion']."</td>";
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
                    $('#tablaproveedor').DataTable( {
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
                              //
                              // {
                              //           extend: "copyHtml5",
                              //           name: "copyBtn",
                              //           text: "<i class='fa fa-copy'> Copiar</i>",
                              //           titleAttr: 'Copiar',
                              //      },
                              //      // 'excelHtml5',
                              //      {
                              //           extend: "excelHtml5",
                              //           name: "excelBtn",
                              //           text: "<i class='fa fa-table'> Exportar a Excel</i>",
                              //           titleAttr: 'Excel',
                              //           exportOptions: {
                              //                columns: [1,2,3,4,5,6]
                              //           }
                              //      },
                              //      // 'csvHtml5',
                              //      {
                              //           extend: "csvHtml5",
                              //           name: "csvBtn",
                              //           text: "<i class='fa fa-file-excel-o'> Exportar a csv</i>",
                              //           titleAttr: 'Csv',
                              //           exportOptions: {
                              //                columns: [1,2,3,4,5,6]
                              //           }
                              //      },
                                   // 'pdfHtml5',
                                   {
                                        extend: "pdfHtml5",
                                        name: "pdfBtn",
                                        className:"btn gris",
                                        text: "<i class='fa fa-file-pdf-o'> Exportar a PDF</i>",
                                        titleAttr: 'pdf',
                                        tittle: 'PDF-EMPLEADOS',
                                        filename: 'EMPLEADOS-PDf',
                                        orientation: 'landscape',
                                        exportOptions: {
                                             columns: [1,3,4,5,6,7,8,9,10,11]
                                        },
                                        customize: function(doc){
                                             doc.content[1].table.widths=[
                                                  '5%',
                                                  // '5%',
                                                  '5%',
                                                  '20%',
                                                  '5%',
                                                  '10%',
                                                  '10%',
                                                  '10%',
                                                  '10%',
                                                  '5%',
                                                  '20%'

                                             ],

                                             doc['footer']= (function(page,pages){
                                                  return {
                                                       columns:[
                                                            {
                                                                 alignment:'center',
                                                                 text: [
                                                                      {text: page.toString(), italics: true}, ' de ',
                                                                      {text: pages.toString(), italics: true}
                                                                 ]
                                                            }
                                                       ],
                                                       margin: [10, 10]
                                                  }
                                             });
                                        }
                                   },
                                   // 'print',
                                   {
                                        extend: "print",
                                        name: "printBtn",
                                        className:"btn gris",
                                        text: "<i class='fa fa-print' aria-hidden='true'> Imprimir</i>",
                                        titleAttr: 'Imprimir',
                                        orientation: 'landscape',
                                        exportOptions: {
                                             columns: [1,3,4,5,6,7,8,9,10,11]
                                        }
                                   },
                                   {className:"btn gris", text: "<i class='fa fa-plus' aria-hidden='true'> Nuevo Empleado </i>", action: function (e, dt, node, config){
                          		     window.location="empleados_Abm.php?accion=N";
                           		}}
                         ]
                    } );
               } );


               function obtenerIdEli(){
                    //Capturar idCliente de la fila donde se hizo clic
                    var fi=0;
                    var id=0;
                    var tabla = document.getElementById("tablaproveedor");
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
                    alertify.confirm("Eliminar registro", "¿Desea eliminar el registro del Empleado?",
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
                         url: "../servicios/EmpleadoServicios.php",
                         data: "id=" + id + "&accion=E",
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 6){
                              alertify.alert("Atención", "El registro del  fue Eliminado",
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
                    var tabla = document.getElementById("tablaproveedor");
                    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    for (i=0; i<filas.length; i++) {
                         filas[i].onclick = function() {
                              //Obtener el id (columna oculta)
                              fi = this.rowIndex;
                              id = tabla.rows[fi].cells[0].innerHTML;
                              window.location="empleados_Abm.php?accion=M&id="+id;
                         }
                    }
               }
          </script>
     </body>
</html>
