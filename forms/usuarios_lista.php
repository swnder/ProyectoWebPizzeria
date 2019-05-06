<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">

          <link rel="icon" href="../img/mozo.ico"/>

          <!-- CSS REQUERIDOS -->
          <link rel="stylesheet" href="../css/misestilos1.css">
          <link rel="stylesheet" href="../alertify/alertify.min.css">
          <!-- Bootstrap -->
          <link rel="stylesheet" href="../bt/bootstrap.min.css">
          <link rel="stylesheet" href="../bt/mdb.css">
          <!-- Datatables -->
          <link rel="stylesheet" href="../dt/datatables.min.css">
          <!-- Alertify -->
          <link rel="stylesheet" href="../alertify/alertify.min.css">
          <link rel="stylesheet" href="../alertify/default.min.css">
          <!-- Font-Awesome -->
          <link rel="stylesheet" href="../font-awesome/font-awesome.min.css">

          <!-- JS REQUERIDOS -->
          <!-- JQuery -->
          <script src="../js/jquery-3.3.1.min.js"></script>
          <!-- Boostrap -->
          <script src="../bt/bootstrap.min.js"></script>
          <!-- Datatables -->
          <script src="../dt/datatables.min.js"></script>
          <!-- Datatables Botones-->
          <script src="../dt/botones/dataTables.buttons.min.js"></script>
          <script src="../dt/botones/buttons.html5.min.js"></script>
          <script src="../dt/botones/jszip.min.js"></script>
          <script src="../dt/botones/buttons.print.min.js"></script>
          <script src="../dt/botones/pdfmake.min.js"></script>
          <script src="../dt/botones/vfs_fonts.js"></script>
          <!-- Alertify -->
          <script src="../alertify/alertify.min.js"></script>
          <title>Usuarios/Pizzeria</title>



     </head>
     <body >
       <!-- cabecera -->
       <nav class="mb-1 navbar navbar-expand-lg navbar-dark gris scl scrolling-navbar fixed-top">
               <div class="container">
         <a class="navbar-brand" href="../menuAdmin.php"><img src="../img/pizza.png" height="30" class="d-inline-block align-top" alt="">Lista de Usuarios</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
           aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
           <ul class="navbar-nav mr-auto">
             <li class="nav-item active">
               <a class="nav-link" href="#">Facturar
                 <span class="sr-only">(current)</span>
               </a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#">Compra</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#">Productos</a>
             </li>
             <!-- clientes despelcagle -->
             <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">Clientes
               </a>
               <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                 <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/clientes_am.php?accion=N"><i class="fa fa-plus-circle"> Agregar</i> </a>
                 <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/clientes_am.php?accion=M"><i class="fa fa-edit"> Modificar</i></a>
                 <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/clientes_lista.php"><i class="fa fa-list-ol"> Lista Clientes</i></a>
               </div>
             </li>
               <!-- caja despelgable -->
             <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">Caja
               </a>
               <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
                 <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/clientes_am.php?accion=N"><i class="fa fa-plus-circle"> Apertura de Caja</i> </a>
                 <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/clientes_am.php?accion=M"><i class="fa fa-times-circle"> Cierre de Caja</i></a>
                 <a class="dropdown-item" href="/ProyectoWebPizzeria/forms/clientes_lista.php"><i class="fa fa-list-ol"> Lista Movimiento</i></a>
               </div>
             </li>
           </ul>
           <ul class="navbar-nav ml-auto nav-flex-icons">
             <li class="nav-item">
               <a class="nav-link waves-effect waves-light">
                 <i class="fa fa-twitter"> Contacto</i>
               </a>
             </li>
             <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <i class="fa fa-cog"> Ajustes</i>
               </a>
               <!-- menu desplegable lado derecho -->
               <div class="dropdown-menu dropdown-menu-right dropdown-default"
                 aria-labelledby="navbarDropdownMenuLink-333">
                 <a class="dropdown-item" href="../forms/ciudadlista.php"><i class="fa fa-city"> Ciudad</i></a>
                 <a class="dropdown-item" href="#"> <i class="fa fa-table"> Mesas</i></a>
                 <a class="dropdown-item" href="#"> <i class="fa fa-star"> Categoriaa</i></a>
                 <a class="dropdown-item" href="#"><i class="fa fa-user-tie"> Empleados</i></a>
                   <a class="dropdown-item" href="../forms/usuarios_lista.php"><i class="fa fa-user"> Usuarios</i></a>
               </div>
             </li>
             <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                 aria-haspopup="true" aria-expanded="false">
                 <i class="fa fa-user"> Cuenta</i>
               </a>
               <!-- menu desplegable lado derecho -->
               <div class="dropdown-menu dropdown-menu-right dropdown-default"
                 aria-labelledby="navbarDropdownMenuLink-333">
                 <a class="dropdown-item" href="#"><i class="fa fa-keycdn"> Cambiar Contraseña</i> </a>
                 <a class="dropdown-item" href="cerrarsesion.php"> <i class="fa fa-sign-out-alt"> Cerrar Sesión</i></a>
                         </div>
             </li>
           </ul>
         </div>


          </div>

       </nav>
<!-- nav bar -->

<!-- datatable -->
<br><br><br>sldkfjñlaksdjfñalsdkfj
          <div class="container bg-dark mt-5" id="tabla">
               <div class="table-responsive">
                     <h2 class="text-center mt-3"></h2>
                    <table class="table table-bordered display nowrap stripe" id="tablaUsuario" style="width:100%">
                         <thead>
                              <tr>
                                   <th hidden>ID</th>
                                   <th>USUARIO</th>
                                   <th>CONTRASEÑA</th>
                                   <th>NIVEL</th>
                                   <!-- <th>TELÉFONO</th> -->
                                   <!-- <th>MÓVIL</th> -->
                                   <!-- <th>TIPO CLIENTE</th> -->
                                   <th>MODIFICAR</th>
                                   <th>ELIMINAR</th>
                              </tr>
                         </thead>
                         <tbody id="tbody">
                           <?php
                                require_once("../servicios/conexion.php");
                                $conex = conexion();
                                // sentencia sql
                                $sql = "SELECT * FROM usuario ORDER BY id";
                                $rs = mysqli_query($conex, $sql);
                                foreach ($rs as $fila) {
                                     echo "<tr>";
                                          echo "<td hidden>".$fila['id']."</td>";
                                          echo "<td>".$fila['usuario']."</td>";
                                          echo "<td>".$fila['pass']."</td>";
                                          echo "<td>".$fila['nivel']."</td>";
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
                    $('#tablaUsuario').DataTable( {
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
                         dom: 'Bfrtip',
                         //botones
                         buttons: [
                            //   // 'copyHtml5',
                            // {extend: "copyHtml5", name: "copyBtn",
                            //   text: "<i class='fa fa-clone'> Copiar</i>",
                            //   titleAttr: "Copiar toda la Tabla"
                            // },
                            // // 'excelHtml5',
                            // {extend: "excelHtml5",
                            //   name: "excelBtn",
                            //   text: "<i class='fa fa-table'> Excel</i>",
                            //   titleAttr: 'Exportar a Excel',
                            //    exportOptions:{
                            //      columns:[1,2,3,4,5,6]
                            //    }
                            // },
                            //   // 'csvHtml5',
                            //   {extend: "csvHtml5",
                            //     name:"csvBtn",
                            //     text:"<i class='fa fa-file-text'> CVS</i>",
                            //     titleAttr:'Exportar a Cvs'},
                            //   // 'pdfHtml5',
                            //   {extend: 'pdfHtml5',
                            //     name: 'pdfBtn',
                            //     text: "<i class='fa fa-file-pdf-o'> PDF</i>",
                            //     titleAttr:'Exportar a Pdf',
                            //     header:'Planilla de Clientes',
                            //     orientation: 'landscape',
                            //     footer:{columns:['left part', {text: 'Right part', alignment: 'right'}]}
                            //   },


                              // 'print',
                              {extend: 'print',
                                className:"btn gris",
                                name:'pdfBtn',
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
                     		     window.location="usuario_Abm.php?accion=N";
                      		}}
                        ] // fin de los botones
                    } );
               } );

               function obtenerIdEli(){
                    //Capturar idCliente de la fila donde se hizo clic
                    var fi=0;
                    var id=0;
                    var tabla = document.getElementById("tablaUsuario");
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
                    alertify.confirm("Eliminar registro", "¿Desea eliminar el registro del Usuario?",
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
                         url: "../servicios/usuariosServicios.php",
                         data: "id=" + id + "&accion=E",
                    }).done( function(resp){ //se ejecuta cuando la solicitud Ajax ha concluido satisfactoriamente
                         if (resp == 5){
                              alertify.alert("Atención", "El registro del usuario fue Eliminado",
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
                    var tabla = document.getElementById("tablaUsuario");
                    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    for (i=0; i<filas.length; i++) {
                         filas[i].onclick = function() {
                              //Obtener el id (columna oculta)
                              fi = this.rowIndex;
                              id = tabla.rows[fi].cells[0].innerHTML;
                              window.location="usuarios_am.php?accion=M&id="+id;
                         }
                    }
               }
          </script>
        </div>


        </div>
        <?php require_once '../plantilla/footer.php'; ?>
     </body>
</html>
