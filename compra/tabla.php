<?php require "../servicios/conexion.php";
  $conexion=conexion();?>
<div class="container">
<div class="row">
  <div class="col-sm-12">
    <h2>Tabla Dinamica facultad auto</h2>
    <div class="table-responsibe">
        <table class="table table-hover table-dark table-bordered table-sm">

        <button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#modalRegistro">Agregar</button>
        <tr>
          <th >Codigo</th>
          <th>Descripcion</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Total</th>

          <th>MOdificar</th>
        </tr>
        <?php
              $sql="Select codigo,descripcion,cantidad, precio from tempcompra";
            $result=mysqli_query($conexion,$sql);
            while ($ver=mysqli_fetch_row($result)) {


         ?>


        <tr name="f">
          <td><?php echo $ver[0] ?></td>
          <td><?php echo $ver[1] ?></td>
          <td id="cant" onchange="cal()" onkeyup="cal()"><?php echo $ver[2] ?></td>
          <td id="pre" onchange="cal()" onkeyup="cal()"><?php echo $ver[3] ?></td>
          <td><input type="number" name="ttfila" id="totalFila"></td>

          <td>
            <button type="button"class="btn btn-danger" name="button">remove</button>
          </td>
        </tr>
        <?php
              }
         ?>


    </table>
    </div>
    </div>

</div>
</div>
<script type="text/javascript">
      function cal() {
          try {
            var cant= parseInt($('#cant').val());
            var pre =parseInt($('#pre').val());
            var expr= cant * pre;
            document.f.ttfila.value = math.eval(document.f.expr.value);
          } catch (e) {
          }
        }
        $(document).ready(function(){
          $('ttfila').load(cal());
        });


</script>
