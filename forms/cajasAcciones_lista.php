<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <title>Cajas</title>
          <link rel="icon" href="../img/icono.png"/>
          <?php require_once "../plantilla/linktablas.php"; ?>
     </head>
     <body >
          <?php
               // session_start();
               //  if (isset($_SESSION['nivelUsuario'])) {
               //      if ($_SESSION['nivelUsuario'] == "VENTA") {
               //         header("Location:../menuvende.php");
               //       }else {
               //         if ($_SESSION['nivelUsuario'] == "INVENTARIO") {
               //           header("Location:../menuinventa.php");
               //          }else{
               //            require_once("../menuadmin.php");
               //          }
               //       }
               //  }else{
               //      header("Location:../denegado.php");
               //  }
           ?>
          <?php require_once "../plantilla/cabecera.php"; ?>
          <div class="container mt-5" id="tabla">
               <div class="table-responsive">
                    <h2 class="text-center mt-3"><b>CAJAS</b></h2><hr>
                    <table class="table table-bordered display nowrap stripe" id="tablaCajas" style="width:100%">
                         <thead>
                              <tr>
                                   <th>ID CAJA</th>
                                   <th>N° CAJA</th>
                                   <th>ESTADO</th>
                                   <th>SELECCIONAR</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
                                   require_once("../servicios/conexion.php");
                                   $conex = conexion();
                                   $sql = "SELECT * FROM caja ORDER BY nro_caja";
                                   $rs = mysqli_query($conex, $sql);
                                   foreach ($rs as $fila) {
                                        echo "<tr>";
                                             echo "<td>".$fila['Caja']."</td>";
                                             echo "<td>".$fila['Numero_caja']."</td>";
                                             echo "<td>".$fila['Estado']."</td>";
                                             echo "<td class='text-center' style='cursor:pointer'  onclick='mod();'><i class='fa fa-check'></i></td>";
                                        echo "</tr>";
                                   }
                                   cerrarBD($conex);
                              ?>
                         </tbody>
                    </table>
                    <!-- <input type="text" name="" id="fila" value=""> -->
               </div>
               <div class="modal hide fade" id="modalcaja" tabindex="-1"  role="dialog" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <!-- Modal Header -->
                           <div class="modal-header">
                                <h2>APERTURA DE CAJA</h2>
                           </div>

                           <!-- Modal Body -->
                           <div class="modal-body">

                               <form role="form">
                                   <div class="form-group">
                                       <label for="cajaID">CAJA N°:</label>
                                       <input type="number" class="form-control" id="cajaID" name="cajaID" readonly/>
                                   </div>
                                   <div class="form-group">
                                       <label for="monto">MONTO APERTURA</label>
                                       <input type="number" class="form-control" name="monto" id="monto" placeholder="Ingrese Monto"/>
                                   </div>
                                   <!-- <input type="hidden" class="form-control" name="accion" id="accion" value="N"/> -->
                               </form>
                           </div>

                           <!-- Modal Footer -->
                           <div class="modal-footer">
                               <button type="button" class="btn btn-success" onclick="validar()">Guardar</button>
                           </div>
                       </div>
                   </div>
               </div>
          </div>

          <script>

               $(document).ready(function() {
                    $('#tablaCajas').DataTable( {
                         scrollX: true,
                         //"scrollY":"200px",para que aparezca la barra
                         scrollCollapse: true,
                         fixedColumns:true,
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
                         dom: 'lfrtip',

                    } );
               } );
               function mod(){
                    var tabla = document.getElementById("tablaCajas");
                    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    for (i=0; i<filas.length; i++) {
                         filas[i].onclick = function() {
                              //Obtener el id (columna oculta)
                              fi = this.rowIndex;
                              nro = tabla.rows[fi].cells[1].innerHTML;
                              estado = tabla.rows[fi].cells[2].innerHTML;
                              if(estado=="ACTIVO"){
                                   $("#modalcaja").modal();
                                   document.getElementById("cajaID").value = nro;
                                   document.getElementById("fila").value = fi;
                                   $("#monto").focus();
                              }else{
                                   alertify.error("Seleccione una Caja ACTIVA ");
                              }

                         }
                    }

               }
               function validar(){
                    if($("#monto").val()>=200000){
                         $('#modalcaja').modal('hide');
                         fila = document.getElementById("fila").value;
                         monto = document.getElementById("monto").value;
                         obtenerId(fila, monto);
                    }else{
                         alertify.error("Debe ingresar monto de apertura superior  o igual a 200.000 GS.");
                    }
               }
               function obtenerId(fila,monto){
                    var tabla = document.getElementById("tablaCajas");
                    nro = tabla.rows[fila].cells[1].innerHTML;
                    caja = tabla.rows[fila].cells[0].innerHTML;
                    estado = tabla.rows[fila].cells[2].innerHTML;
                    $.ajax({
                         type: "POST",
                         dataType: 'html',
                         url: "../servicios/cajaOcupada.php",
                         data: "caja=" + caja+"&estado=OCUPADO&nro="+nro+"&monto="+monto,
                    }).done( function(resp){
                         //alert(resp);
                         window.location="compra_cab_lista.php";
                    }).fail( function(resp){ //se ejecuta en que caso de que haya ocurrido algún error
                         alertify.error(resp);
                    });
               }
          </script>
     </body>
</html>
