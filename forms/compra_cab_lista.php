<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <title>Compras</title>
          <link rel="icon" href="../img/pizzeria.ico"/>
          <?php require_once "../plantilla/linktablas.php"; ?>
     </head>
     <body class="bg gris">
          <?php
               // session_start();
               //  if (isset($_SESSION['nivelUsuario'])) {
               //      if ($_SESSION['nivelUsuario'] == "VENTA") {
               //         header("Location:../menuvende.php");
               //       }else {
               //         if ($_SESSION['nivelUsuario'] == "INVENTARIO") {
               //             header("Location:../menuinventa.php");
               //          }else{
               //            require_once("../menuadmin.php");
               //          }
               //       }
               //  }else{
               //      header("Location:../denegado.php");
               //  }
               //  if($_SESSION["caja"]==""){
               //       echo '<script>
               //           alertify.alert("Atención", "Operación Denegada, debe seleccionar una Caja para realizar la Operación!",
               //                function(){
               //                     window.location="cajasAcciones_lista.php";
               //                }
               //           );
               //       </script>';
               //  }
           ?>
           <br><br><br>
           <!-- <i class="fa fa-money" style="position:absolute;top:5px; right:17.5%;color:white;"></i><label style="position:absolute;top:0; right:11.5%;color:white;"> -->
             <?php
                // if (isset($_SESSION['caja'])){
                //      echo " CAJA N°: ".$_SESSION['caja'];
                //      echo "<br>";
                //      echo " En CAJA: ".$_SESSION['montoOperaciones']." Gs.";
                // }
            ?>
          <!-- </label> -->
          <div class="container" >
               <div class="table-responsive">
                    <h2 class="text-center mt-3"><b>COMPRAS</b></h2><hr>
                    <table class="table table-bordered display nowrap stripe" id="tablaCompras" style="width:100%">
                         <thead>
                              <tr>
                                   <th hidden>ID</th>
                                   <th>N° FACTURA</th>
                                   <th>FECHA</th>
                                   <th>R.U.C.</th>
                                   <th>RAZÓN SOCIAL</th>
                                   <th>CONDICIÓN</th>
                                   <th>TOTAL IVA</th>
                                   <th>TOTAL</th>
                                   <th>ESTADO</th>
                                   <th>DETALLE</th>
                                   <th>ANULAR</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                                   require_once("../servicios/conexion.php");
                                   $conex = conexion();
                                   $sql = "SELECT c.Id_cabecera, c.Fecha, SUM(Sub_total) Total, c.Estado, c.Condicion, SUM(Iva) IVA_total, c.Numero_factura, p.Ruc,p.Razon_social
                                   FROM   compra_cabecera c
                                   JOIN proveedores p ON p.Ruc=c.Ruc
                                   LEFT JOIN compra_detalle d
                                   ON  c.Id_cabecera=d.Id_cabecera
                                   GROUP BY c.Id_cabecera ORDER BY fecha DESC";
                                   $rs = mysqli_query($conex, $sql);
                                   foreach ($rs as $fila) {
                                        echo "<tr>";
                                             echo "<td hidden>".$fila['Id_cabecera']."</td>";
                                             echo "<td>".$fila['Numero_factura']."</td>";
                                             $date = date_create($fila['Fecha']);
                                             $fecha = date_format($date,"d/m/Y");
                                             echo "<td>".$fecha."</td>";
                                             echo "<td>".$fila['Ruc']."</td>";
                                             echo "<td>".$fila['Razon_social']."</td>";
                                             echo "<td>".$fila['Condicion']."</td>";
                                             if($fila['IVA_total']== ""){
                                                  echo "<td>0</td>";
                                             }else{
                                                  echo "<td>".$fila['IVA_total']."</td>";
                                             }
                                             if($fila['Total']== ""){
                                                  echo "<td>0</td>";
                                             }else{
                                                  echo "<td>".$fila['Total']."</td>";
                                             }
                                             echo "<td>".$fila['Estado']."</td>";
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
                                        class:"btn btn-danger",
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
                                        class:"btn btn-danger",
                                        style:"color:black;"
                                   },
                                   text: "<i class='fa fa-table'><b> Exportar a Excel</b></i>",
                                   titleAttr: 'Excel',
                                   exportOptions: {
                                        columns: [1,2,3,4,5,6,7,8]
                                   }
                              },
                              // 'pdfHtml5',
                              {
                                   extend: "pdfHtml5",
                                   name: "pdfBtn",
                                   attr:{
                                        class:"btn btn-danger",
                                        style:"color:black;"
                                   },
                                   text: "<i class='fa fa-file-pdf-o'><b> Exportar a PDF</b></i>",
                                   titleAttr: 'pdf',
                                   tittle: 'PDF-COMPRAS',
                                   filename: 'Compras-PDf',
                                   // orientation: 'landscape',
                                   exportOptions: {
                                        columns: [1,2,3,4,5,6,7,8]
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
                                        class:"btn btn-danger",
                                        style:"color:black;"
                                   },
                                   action: function (e, dt, node, config){
                     		     window.location="compra_cab_am.php?accion=N";
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
