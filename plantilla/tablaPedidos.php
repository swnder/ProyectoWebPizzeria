<!--Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Seleccione un Producto</h4>

      </div>
      <div class="modal-body">
        <div class="container gris ">
             <div class="table-responsive" >
                  <h2 class="text-center ">LISTA DE PRODUCTOS</h2>
                  <table class="table table-bordered display nowrap stripe" id="tablaproducto" style="width:100%">
                       <thead>
                            <tr>
                                 <th hidden>ID</th>
                                 <th>ELEGIR</th>
                                 <th>NOMBRE</th>
                                 <th>CATEGORIA</th>
                                 <th>MARCA</th>
                                 <th>PRECIO</th>
                                 <th>TAMANO</th>
                                 <th>STOCK</th>
                            </tr>
                       </thead>
                       <tbody>
                            <?php
                                 require_once("../servicios/conexion.php");
                                 $conex = conexion();
                                 $sql = "SELECT p.id,p.nombre,c.categoria,m.marca,p.precio,t.tamano,p.stock FROM producto p JOIN categoria c JOIN marca m JOIN tamano t ON p.categoria=c.id AND p.marca=m.id AND p.tamano=t.id ";
                                 $rs = mysqli_query($conex, $sql);
                                 foreach ($rs as $fila) {
                                      echo "<tr>";
                                           echo "<td hidden>".$fila['id']."</td>";
                                              echo "<td class='text-center' style='cursor:pointer' onclick='obtenerIdModi()'>§<i class='fa fa-hand-pointer'></i></td>";
                                           echo "<td>".$fila['nombre']."</td>";
                                           echo "<td>".$fila['categoria']."</td>";
                                           echo "<td>".$fila['marca']."</td>";
                                           echo "<td>".$fila['precio']."</td>";
                                           echo "<td>".$fila['tamano']."</td>";
                                           echo "<td>".$fila['stock']."</td>";

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
                  $('#tablaproducto').DataTable( {

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
                       dom: 'frtip'

                  } );
             } );
             var ultimo=0;
             function obtenerIdModi(){
                  var fi=0;
                  var id=0;
                  var cantidad=1;
                  var nombre="";

                  var tabla = document.getElementById("tablaproducto");
                  var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    // la otra tabla
                    var tab = document.getElementById("detalles");
                    var fil = tab.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                    // nombre para el id de cada tabla que se mete en la tabla


                    var mas1=fil.length;
                    if(mas1==ultimo){
                      var pro="prod"+ mas1;
                      ultimo = mas1;
                    }else {
                      ultimo++;
                      var pro="prod"+ ultimo;
                      ultimo =ultimo;
                    };

                    var con="fila"+fil.length;
                    // alert("ultimo: "+ultimo);
                    // alert("ultimo sumado: "+ultimo);
                    // alert("Primero: "+mas1);


                  for (i=0; i<filas.length; i++) {

                       filas[i].onclick = function() {
                            //Obtener el id (columna oculta)
                            fi = this.rowIndex;
                            id = tabla.rows[fi].cells[0].innerHTML;
                            nombre= tabla.rows[fi].cells[2].innerHTML;
                            categoria=tabla.rows[fi].cells[3].innerHTML;
                            tamano=tabla.rows[fi].cells[6].innerHTML;
                            // alertify.success("hola"+nombre);

                          // document.getElementById("idprod").value=id;
                            product=categoria+', '+nombre+', '+tamano+'.';
                            $('#detalles').append('<tr name="filas" id='+con+'><td><button type="button" onclick="remover();" class="btn btn-warning">X</button></td><td><input min="1" type=number id="cantidadProd" name="pro[]" value='+cantidad+'></td><td>'+product+'</td><td>'+id+'</td><td hidden>'+pro+'</td></tr>');
                            // probando con el array

                            $('#form_pedidos').append('<input type="hidden" name="pro[]" id="'+pro+'" value='+id+'>');
                            //  sin el array
                            // $('#form_pedidos').append('<input type="hidden" name="'+pro+'" id="filasdetalles" value='+id+'>');


                       }
                  }
             };


             function remover(){
               var b=1;

               var tabla = document.getElementById("detalles");
               var fi=0;
               var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
               for (i=0; i<filas.length; i++) {
                    filas[i].onclick = function() {
                         //Obtener el id (columna oculta)
                         fi = this.rowIndex;
                         id = tabla.rows[fi].cells[4].innerHTML;
                         if(b==1){
                          tabla.rows[fi].remove();
                          // borrar los input
                          $("input[id="+id+"]").remove();
                          b=0;
                          }
                     }
                    }


             };
        </script>

      </div>
      <div class="modal-footer">

        <button class="btn btn-default" id="cerrarCliente" type="button" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal -->
