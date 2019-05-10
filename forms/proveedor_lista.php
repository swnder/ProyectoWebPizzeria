<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <title>Proveedor</title>
          <?php require_once "../plantilla/linktablas.php";?>
     </head>
     <body >
       <?php require_once "../plantilla/cabecera.php" ?>
       <br><br><br>

           <div class="container">
               <div class="table-responsive" id="tabla">
                    <h2 class="text-center mt-5">PROVEEDOR</h2>
                    <table class="table table-bordered display nowrap stripe" id="tablaproveedor" style="width:100%">
                         <thead>
                              <tr>
                                   <th hidden>ID</th>
                                   <th>R.U.C.</th>
                                   <th>RAZON SOCIAL</th>
                                   <th>TELÉFONO</th>
                                   <th>DIRECCIÓN</th>
                                   <th>CIUDAD</th>
                                   <th>MODIFICAR</th>
                                   <th>ELIMINAR</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                                   require_once("../servicios/conexion.php");
                                   $conex = conexion();
                                   $sql = "SELECT p.id,p.ruc,p.nombre,p.telefono,p.direccion,c.ciudad FROM proveedor p JOIN ciudad c ON p.ciudad=c.id ";
                                   $rs = mysqli_query($conex, $sql);
                                   foreach ($rs as $fila) {
                                        echo "<tr>";
                                             echo "<td hidden>".$fila['id']."</td>";
                                             echo "<td>".$fila['ruc']."</td>";
                                             echo "<td>".$fila['nombre']."</td>";
                                             echo "<td>".$fila['telefono']."</td>";
                                             echo "<td>".$fila['direccion']."</td>";
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

                              {
                                        extend: "copyHtml5",
                                        name: "copyBtn",
                                        text: "<i class='fa fa-copy'> Copiar</i>",
                                        titleAttr: 'Copiar',
                                   },
                                   // 'excelHtml5',
                                   {
                                        extend: "excelHtml5",
                                        name: "excelBtn",
                                        text: "<i class='fa fa-table'> Exportar a Excel</i>",
                                        titleAttr: 'Excel',
                                        exportOptions: {
                                             columns: [1,2,3,4,5,6]
                                        }
                                   },
                                   // 'csvHtml5',
                                   {
                                        extend: "csvHtml5",
                                        name: "csvBtn",
                                        text: "<i class='fa fa-file-excel-o'> Exportar a csv</i>",
                                        titleAttr: 'Csv',
                                        exportOptions: {
                                             columns: [1,2,3,4,5,6]
                                        }
                                   },
                                   // 'pdfHtml5',
                                   {
                                        extend: "pdfHtml5",
                                        name: "pdfBtn",
                                        text: "<i class='fa fa-file-pdf-o'> Exportar a PDF</i>",
                                        titleAttr: 'pdf',
                                        tittle: 'PDF-CLIENTES',
                                        filename: 'Clientes-PDf',
                                        orientation: 'landscape',
                                        exportOptions: {
                                             columns: [1,2,3,4,5,6]
                                        },
                                        customize: function(doc){
                                             doc.content[1].table.widths=[
                                                  '15%',
                                                  '25%',
                                                  '30%',
                                                  '10%',
                                                  '10%',
                                                  '10%'
                                             ],
                                             doc['footer']= (function(page,pages){
                                                  return {
                                                       columns:[
                                                            {
                                                                 alignment:'center',
                                                                 text: [
                                                                      {text: page.toString(), italics: true}, ' of ',
                                                                      {text: pages.toString(), italics: true}
                                                                 ]
                                                            }
                                                       ],
                                                       margin: [10, 0]
                                                  }
                                             });
                                        }
                                   },
                                   // 'print',
                                   {
                                        extend: "print",
                                        name: "printBtn",
                                        text: "<i class='fa fa-print' aria-hidden='true'> Imprimir</i>",
                                        titleAttr: 'Imprimir',
                                        orientation: 'landscape',
                                        exportOptions: {
                                             columns: [1,2,3,4,5,6]
                                        }
                                   },
                                   {text: "<i class='fa fa-plus' aria-hidden='true'> Nuevo Proveedor </i>", action: function (e, dt, node, config){
                          		     window.location="proveedor_am.php?accion=N";
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
                    alertify.confirm("Eliminar registro", "¿Desea eliminar el registro del Proveedor?",
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
                         url: "../servicios/proveedorServicios.php",
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
                    var tabla = document.getElementById("tablaproveedor");
                    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    for (i=0; i<filas.length; i++) {
                         filas[i].onclick = function() {
                              //Obtener el id (columna oculta)
                              fi = this.rowIndex;
                              id = tabla.rows[fi].cells[0].innerHTML;
                              window.location="proveedor_am.php?accion=M&id="+id;
                         }
                    }
               }
          </script>
     </body>
</html>
