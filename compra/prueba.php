<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<script src="../js/math.min.js"></script>
<script src="../js/funciones.js"></script>
    <title>Compra</title>
    <?php require_once "../plantilla/linktablas.php"; ?>

  </head>
    <body>

        <div class="container">

        <div id="tab">

        </div>
      </div>

      <!-- MOdal para registros nuevos -->


<!-- Modal -->
<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Agrega nuevo Producto</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <label for="producto" class="col-12 col-sm-4 control-label">Producto:</label>
      <select id="producto" name="producto" class="form-control">
        <?php
          require_once("../servicios/conexion.php");
          $con = conexion();
          $sql = "SELECT * FROM producto";
          $res = mysqli_query($con, $sql);
            foreach ($res as $row) {
                echo "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
              }
        ?>
      </select>

      <label for="descripcion">Descripcion</label>
      <textarea name="descripcion" id="descripcion" class="form-control input-sm" rows="3" cols="5"></textarea>

      <label>Cantidad</label>
      <input type="text" name="descripcion" value="" id="cantidad" class="form-control input-sm">
      <label>Precio</label>
      <input type="text" name="descripcion" value="" id="precio" class="form-control input-sm">




    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="guardarnuevo">Agregar</button>

    </div>
  </div>
</div>
</div>


<!-- MOdal para Edición de datos -->


<!-- Modal -->
<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Actualizar</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
  <input type="text" hidden="" id="producto" name="" value="">
  <label>Nombre</label>
  <input type="text" name="" value="" id="nombreu" class="form-control input-sm">
  <label>Apellido</label>
  <input type="text" name="" value="" id="apellidou" class="form-control input-sm">
  <label>Email</label>
  <input type="text" name="" value="" id="Emailu" class="form-control input-sm">
  <label>telefono</label>
  <input type="text" name="" value="" id="telefonou" class="form-control input-sm">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal" id="actualziardatos">Actualizar</button>

</div>
</div>
</div>
</div>





  </body>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tab').load('tabla.php');

   });
  </script>

  <script type="text/javascript">
  $(document).ready(function() {
    $('#guardarnuevo').click(function(){
      alert("hola");
      codigo=$('#producto').val();
      descripcion=$('#descripcion').val();
      cantidad=$('#cantidad').val();
      precio=$('#precio').val();
      agregarDatos(codigo,descripcion,cantidad,precio);
    });

 });
 function agregarDatos(codigo,descripcion,cantidad,precio){
   codigo= "codigo"+descripcion="&descripcion"+cantidad="&cantidad"+precio="&precio",
   $.ajax({
     type:"POST",
     url:"agregarDatos.php",
     data:codigo,
     success:function(r){
       if (r==1) {
         $('#tab').load('tabla.php');
         alertify.success("agregado con exito");
       }else {
         alertify.error("Fallo del servidor");
       }
     }

   });
 };



  </script>
</html>
