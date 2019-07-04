<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Compra</title>
    <link rel="icon" href="../img/pizzeria.ico"/>
    <?php require_once "../plantilla/linktablas.php"; ?>

  </head>
  <body>
    <!-- cabecera -->
    <?php require_once "../plantilla/CabecerasSegunNivel.php"; ?>
    <div class="container gris mt-5">
         <div class="table-responsive">
              <h2 class="text-center mt-3"><b>COMPRAS</b></h2><hr>
              <table class="table table-bordered display nowrap stripe"           id="tablaCompras" style="width:100%">
                   <thead>
                        <tr>
                             <th hidden>ID</th>
                             <th>N° FACTURA</th>
                             <th>FECHA</th>
                             <th>PROVEEDOR</th>
                             <th>TIPO DE COMPRA</th>
                             <th>Cod.</th>
                             <th>DESCRIPCION</th>
                             <th>CANTIDAD</th>
                             <th>PRECIO</th>
                             <th>IVA</th>
                             <th>DESCUETNO</th>
                             <th>TOTALCOMPRA</th>
                             <th>ANULAR</th>
                             <th></th>
                        </tr>
                   </thead>
                   <tbody>
                        <?php
                             require_once("../servicios/conexion.php");
                             $conex = conexion();
                             $sql = "SELECT c.nro_factura,c.fecha, p.nombre, c.tipodeCompra,c.producto,c.descripcion,c.cant,c.precio, c.iva,c.descuento,c.totalcompra FROM compraproduc c INNER JOIN proveedor p ON c.proveedor=p.id";
                             $rs = mysqli_query($conex, $sql);
                             foreach ($rs as $fila) {
                                  echo "<tr>";
                                       echo "<td hidden>".$fila['id']."</td>";
                                       echo "<td>".$fila['nro_factura']."</td>";
                                       $date = date_create($fila['fecha']);
                                       $fecha = date_format($date,"d/m/Y");
                                       echo "<td>".$fecha."</td>";
                                       echo "<td>".$fila['nombre']."</td>";
                                       echo "<td>".$fila['tipodeCompra']."</td>";
                                       echo "<td>".$fila['producto']."</td>";
                                       echo "<td>".$fila['descripcion']."</td>";
                                       echo "<td>".$fila['cant']."</td>";
                                       echo "<td>".$fila['precio']."</td>";
                                       echo "<td>".$fila['iva']."</td>";
                                       echo "<td>".$fila['descuento']."</td>";
                                       echo "<td>".$fila['totalcompra']."</td>";

                                       echo "<td class='text-center' style='cursor:pointer' onclick='obtenerIdDeta()'><i class='fa fa-search'></i></td>";
                                       echo "<td class='text-center' style='cursor:pointer' onclick='obtenerIdEli()'><i class='fa fa-times-circle'></i></td>";

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
                        $('#tablaCompras').DataTable( {
                             scrollX: true,
                             scrollCollapse: true,
                             ordering:false,//para que la tabla no ordene automaticamente
                             columnDefs:[//para ajustar tamaño del dataTables
                                {"width":"10%", "targets":[1,2,3,4,5,7,8,9,10]},
                                {"width":"50%", "targets":[6]}
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

                             lengthMenu:				[[5, 10, 20, 50, -1], [5, 10, 20, 50, "Todos"]],
    				     iDisplayLength:			5,
                             //dom: 'lBf',
                             dom: 'Blfrtip',
                             buttons: [
                                  // 'copyHtml5',
                                  {
                                       extend: "copyHtml5",
                                       name: "copyBtn",
                                       attr:{
                                            //id: "copyb"
                                            class:"btn gris",
                                            style:"color:black;"
                                       },
                                       text: "<i class='fa fa-copy'> <b>Copiar</b></i>",
                                       titleAttr: 'Copiar',
                                  },
                                  // 'excelHtml5',
                                  {
                                       extend: "excelHtml5",
                                       name: "excelBtn",
                                       attr:{
                                            class:"btn gris",
                                            style:"color:black;"
                                       },
                                       text: "<i class='fa fa-table'><b> Exportar a Excel</b></i>",
                                       titleAttr: 'Excel',
                                       exportOptions: {
                                            columns: [1,2,3,4,5,6,7,8,9,10,11]
                                       }
                                  },
                                  // 'pdfHtml5',
                                  {
                                       extend: "pdfHtml5",
                                       name: "pdfBtn",
                                       attr:{
                                            class:"btn gris",
                                            style:"color:black;"
                                       },
                                       text: "<i class='fa fa-file-pdf-o'><b> Exportar a PDF</b></i>",
                                       titleAttr: 'pdf',
                                       tittle: 'PDF-COMPRAS',
                                       filename: 'Compras-PDf',
                                       orientation: 'landscape',
                                       exportOptions: {
                                            columns: [1,2,3,4,5,6,7,8,9,10,11]
                                       },
                                       customize: function(doc){
                                            // doc.content[1].table.widths=[
                                            //      '50%',
                                            //      '50%'
                                            // ],
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
                                                      margin: [10, 0]
                                                 }
                                            });
                                       }
                                  },
                                  {
                                       text: "<i class='fa fa-plus' aria-hidden='true'> <b>Nueva Compra</b> </i>",
                                       attr:{
                                            class:"btn gris",
                                            style:"color:black;"
                                       },
                                       action: function (e, dt, node, config){
                         		     window.location="Compra_Abm.php?accion=N";
                          		     }}
                             ]
                        } );
                   } );

                   function obtenerIdEli(){
                        //Capturar idCliente de la fila donde se hizo clic
                        var fi=0;
                        var id=0;
                        var tabla = document.getElementById("tablaCompras");
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
                        alertify.confirm("Eliminar registro", "¿Desea eliminar el registro de la Compra?",
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
                             url: "../servicios/compra_cab_Servicios.php",
                             data: "id=" + id + "&accion=E",
                        }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                             if (resp == 6){
                                  alertify.alert("Atención", "El registro de la Compra fue Eliminado",
                                       function(){
                                            location.reload();
                                       }
                                  );
                             }else if (resp == 7) {
                               alertify.alert("Atención", "Error al Eliminar, Compra ya esta relacionada con otra tabla!",
                                    function(){
                                         location.reload();
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
