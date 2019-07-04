<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="black">
    <title>Sistema Pizzeria/Lista_Ciudad</title>
    <link rel="icon" href="../img/pizzeria.ico"/>
    <?php include "../plantilla/linktablas.php"; ?>
  </head>
   <body >
       <!--Navbar -->
       <?php require_once "../plantilla/CabecerasSegunNivel.php"; ?>
  <!-- tabla de la vista -->
   <div class="container bg-dark mt-5" id="tabla">
      <div class="table-responsive" >
            <!-- cabecera del la tabla -->
           <h1 class="text-center mt-3">Lista de Cuidades</h1>
           <table class="table table-bordered display nowrap stripe mb-3"  id="tablaCiudad" style="width:100%">
                <thead>
                     <tr>
                          <th hidden>ID</th>
                          <th>CIUDAD</th>
                          <th>DEPARTAMENTO</th>
                          <th>MODIFICAR</th>
                          <th>ELIMINAR</th>
                     </tr>
                </thead>
                <tbody id="tbody">
                     <?php
                          require_once("../servicios/conexion.php");
                          $conex = conexion();
                          $sql = "SELECT * FROM ciudad ORDER BY id";
                          $rs = mysqli_query($conex, $sql);
                          foreach ($rs as $fila) {
                               echo "<tr>";
                                    echo "<td hidden>".$fila['id']."</td>";
                                    echo "<td>".$fila['ciudad']."</td>";
                                    echo "<td>".$fila['departamento']."</td>";
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
                     $('#tablaCiudad').DataTable( {
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
 				    iDisplayLength:			5,
                          //dom: 'lBf',
                          dom:'Bftipr',
                            buttons:[
                              // 'copyHtml5',
                              // 'excelHtml5',
                              // 'csvHtml5',
                               // 'print',
                               {extend: 'print',
                                 name:'pdfBtn',
                                 className:'btn gris',
                                 text: "<i class='fa fa-print'> Imprimir</i>",
                                 titleAttr: 'Imprimir todo el documento',
                                 customize: function ( win ) {
                                     $(win.document.body)
                                         .css('@page { size: landscape; }');

                                     $(win.document.body).find( 'table' )
                                         .addClass( 'compact' )
                                         .css( 'font-size', 'inherit' );
                                 }
                             },

                               {text:"<i class ='fa fa-plus-circle'> Nuevo</i>",
                                 name:"nuevoBtn",
                                 className:"btn gris",
                                 titleAttr:'Cargar nuevo Registro', action: function (e, dt, node, config){
                      		     window.location="ciudad_Abm.php?accion=N";
                       		}},
                        ] // fin de los botones
                     } );
                } );

                function obtenerIdEli(){
                     //Capturar idCliente de la fila donde se hizo clic
                     var fi=0;
                     var id=0;
                     var tabla = document.getElementById("tablaCiudad");
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
                     alertify.confirm("Eliminar registro", "¿Desea eliminar el registro de la Ciudad?",
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
                          url: "../servicios/CiudadServicios.php",
                          data: "id=" + id + "&accion=E",
                     }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                          if (resp == 5){
                               alertify.alert("Atención", "El registro de la ciudad fue Eliminado",
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
                     var tabla = document.getElementById("tablaCiudad");
                     var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                     for (i=0; i<filas.length; i++) {
                          filas[i].onclick = function() {
                               //Obtener el id (columna oculta)
                               fi = this.rowIndex;
                               id = tabla.rows[fi].cells[0].innerHTML;
                               window.location="../forms/ciudad_Abm.php?accion=M&id="+id;
                          }
                     }
                }
           </script>


        <!-- Footer -->
        <?php require_once "pantilla/footer.php" ?>
        <!-- Footer -->

      </body>





</html>
