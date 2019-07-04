<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <link rel="icon" href="../img/pizzeria.ico"/>
          <title>Cajas</title>
          <link rel="icon" href="../img/pizzeria.png"/>
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
          <?php require_once "../plantilla/CabecerasSegunNivel.php"; ?>
          <div class="container mt-5" id="tabla">
               <div class="table-responsive">
                    <h2 class="text-center mt-3"><b>CAJAS</b></h2><hr>
                    <table class="table table-bordered display nowrap stripe" id="tablaCajas" style="width:100%">
                         <thead>
                              <tr>
                                   <th hidden>ID CAJA</th>
                                   <th>N° CAJA</th>
                                   <th>ABRIO</th>
                                   <th>FECHA APERTURA</th>
                                   <th>MONTO</th>
                                   <th>CERRO</th>
                                   <th>FECHA CIERRE</th>
                                   <th>MONTO</th>
                                   </tr>
                         </thead>
                         <tbody>
                              <?php
                                   require_once("../servicios/conexion.php");
                                   $conex = conexion();
                                   $sql = "SELECT c.id, c.nro_caja, e.nombre as abrio, c.fechaAper,c.Apertura, p.nombre as cerro, c.fechaCie, c.ciere FROM caja c LEFT JOIN empleado e ON c.idEmpleAper = e.id LEFT JOIN empleado p ON c.idEmpleCie = p.id ORDER BY nro_caja";
                                   $rs = mysqli_query($conex, $sql);
                                   foreach ($rs as $fila) {
                                        echo "<tr>";
                                          echo "<td hidden>".$fila['id']."</td>";
                                             echo "<td>".$fila['nro_caja']."</td>";

                                             echo "<td>".$fila['abrio']."</td>";
                                             echo "<td>".$fila['fechaAper']."</td>";
                                             echo "<td>".$fila['Apertura']."</td>";
                                             echo "<td>".$fila['cerro']."</td>";
                                             echo "<td>".$fila['fechaCie']."</td>";
                                             echo "<td>".$fila['ciere']."</td>";

                                        echo "</tr>";
                                   }
                                   cerrarBD($conex);
                              ?>
                         </tbody>
                    </table>
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
                                   dom: 'Blfrtip',
                                   buttons: [
                                        //
                                        // {
                                        //           extend: "copyHtml5",
                                        //           name: "copyBtn",
                                        //           text: "<i class='fa fa-copy'> Copiar</i>",
                                        //           titleAttr: 'Copiar',
                                        //      },
                                        //      // 'excelHtml5',
                                             {
                                                  extend: "excelHtml5",
                                                  className:"btn gris",
                                                  name: "excelBtn",
                                                  text: "<i class='fa fa-table'> Exportar a Excel</i>",
                                                  titleAttr: 'Excel',
                                                  exportOptions: {
                                                       columns: [1,2,3,4,5,6,7]
                                                  }
                                             },

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
                                                  tittle: 'PDF-Caja',
                                                  filename: 'Caja-PDf',
                                                  orientation: 'landscape',
                                                  exportOptions: {
                                                       columns: [1,2,3,4,5,6,7]
                                                  },
                                                  customize: function(doc){
                                                       doc.content[1].table.widths=[
                                                            '10%',
                                                            '10%',
                                                            '20%',
                                                            '10%',
                                                            '10%',
                                                            '20%',
                                                            '10%'
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
                                                       columns: [1,2,3,4,5,6,7]
                                                  }
                                             },

                                   ]

                              } );
                         } );
                         </script>

</body>
</html>
