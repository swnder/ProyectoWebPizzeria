<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <?php require_once "../plantilla/linktablas.php"; ?>
  </head>
  <body id="ingresobody" >

    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Ingresos <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>Agregar</button></h1>
  <div class="box-tools pull-right">

  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body" style="height: 400px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">

    <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
     <a data-toggle="modal" href="#myModal">
       <button id="btnAgregarArt" type="button" class="btn btn-primary"><span class="fa fa-plus"></span>Agregar Articulos</button>
     </a>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-xs-12">
         <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
       <thead style="background-color:#A9D0F5">
        <th>Opciones</th>
        <th>Articulo</th>
        <th>Cantidad</th>
        <th>Precio Compra</th>
        <th>Precio Venta</th>
        <th>Subtotal</th>
       </thead>
       <tfoot>
         <th>TOTAL</th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th><h4 id="total">S/. 0.00</h4><input type="hidden" name="total_compra" id="total_compra"></th>
       </tfoot>
       <tbody>

       </tbody>
     </table>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  <!--Modal-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Articulo</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Nombre</th>
              <th>Opcion</th>

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
                             echo "<td>".$fila['nombre']."</td>";
                              echo "<td class='text-center' style='cursor:pointer' onclick='obtenerIdModi()'><i class='fa fa-hand-point'> Elegir</i></td>";
                             // echo "<td>".$fila['categoria']."</td>";
                             // echo "<td>".$fila['marca']."</td>";
                             // echo "<td>".$fila['precio']."</td>";
                             // echo "<td>".$fila['tamano']."</td>";
                             // echo "<td>".$fila['stock']."</td>";
                             // echo "</tr>";
                   }
                   cerrarBD($conex);
              ?>
            </tbody>
            <tfoot>
              <th>Nombre</th>
              <th>Opcion</th>

            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- fin Modal-->

 <script src="./js/ingreso.js"></script>


    </body>
  </html>
