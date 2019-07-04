<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="black">
    <link rel="icon" href="../img/pizzeria.ico"/>
    <?php include "../plantilla/linktablas.php"; ?>
    <title>Sistema Pizzeria/COMPRA</title>
    <?php
         if (!isset($_GET["accion"])){
              header("Location: malaidea.php");
         }
    ?>
    <title>Compra</title>
  </head>

  <body class="bg-dark text-white">
            <?php
             if (isset($_GET['id'])){ //Solo para modificar
                  require_once("../servicios/conexion.php");
                  $conex = conexion();
              $id = $_GET['id'];
              $sql = "SELECT * FROM compraproduc WHERE id = '$id'";
              $res = mysqli_query($conex, $sql);
              $reg = mysqli_fetch_array($res);
              }
        ?>
        <!-- encabezado -->
        <div class="container gris">
          <h1 class="text-center mt-3 font-weight-bold" >Registro de Compras</h1>
          <div class="container outer-section" >

               <form class="form-horizontal" role="form" id="datos_factura" method="post">

                 <div class="row" id="row">
                      <div class="col">

                        <form id="form_compra" onkeypress="if(event.keyCode == 13) event.returnValue =validarCampos();">
                             <!-- PRIMERA FILA -->
                             <div class="form-group row mt-3" >
                                    <!-- logo -->
                                    <div class="col-12 col-md-2 col-sm-2">
                                      <a href="#" >  <img src="/ProyectoWebPizzeria/img/pizza.png" alt="Logo web" width="100%" height="100%"></a>
                                    </div>

                                    <div class="col-12 col-md-4 col-sm-4">
                                        <strong>E-mail : pizzeriasystem@pizza.com</strong>
                                        <br />
                                        <strong>Teléfono :</strong> <?php echo $rw['telefono'];?> <br />
                    					<strong>Sitio web :</strong> <?php echo $rw['web'];?>

                                    </div>
                                    <div class="col-12 col-md-4 col-sm-4">
                                        <strong><?php echo $rw['nombre_comercial'];?>  </strong>
                                        <br />
                                        Dirección : <?php echo $rw['direccion'];?>
                                    </div>
                                  </div>
                                  <!-- termina primera fila -->
                                  <div class="form-group row" id="row2">
                                       <div class="col-12 col-md-4 mb-3">
                                         <label for="ciudad" class="font-weight-bold">Proveedor:</label>
                                         <select id="idciudad" name="idciudad" class="form-control">
                                           <?php
                                             require_once("../servicios/conexion.php");
                                             $con = conexion();
                                             $sql = "SELECT * FROM proveedor";
                                             $res = mysqli_query($con, $sql);
                                               foreach ($res as $row) {
                                                   echo "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
                                               }
                                           ?>
                                         </select>
                                       </div>
                                       <div class="col-12 col-md-4">
                                         <h4><strong>R.U.C.: </strong>
                                         <span id="ruc"></span>
                                         <h4><strong>Direcion: </strong>
                                         <span id="direccion"></span>
                                         <!-- <h4><strong>E-mail: </strong><span id="email"></span></h4> -->
                                         <h4><strong>Teléfono: </strong><span id="telefono"></span></h4>
                                       </div>
                                       <!-- tercera columna -->
                                       <div class="col-12 col-md-4 col-sm-4">
                                          <h4><strong>Factura #: </strong><?php echo $numero;?></h4>
                                           <h4><strong>Fecha: </strong> <?php echo date("d/m/Y");?></h4>


                                       </div>
                                 </div>
                                 <!-- termina segunda fila -->
<!-- tabladetalle -->
<div class="container" id="print-area">


</div>
                              </div>
                              <!-- termina div col -->

                  </div>
                  <!-- termina row -->


               <div class="row"> <hr /></div>
                <div class="row pad-bottom  pull-right">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <button type="submit" class="btn btn-success ">Guardar factura</button>
                    </div>
                </div>
        		</form>
  </div>
  <!-- container otra seccion -->

        	<form class="form-horizontal" name="guardar_item" id="guardar_item">
        			<!-- Modal -->
        			<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        			  <div class="modal-dialog" role="document">
        				<div class="modal-content">
        				  <div class="modal-header">
        					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        					<h4 class="modal-title" id="myModalLabel">Nuevo Ítem</h4>
        				  </div>
        				  <div class="modal-body">

        					  <div class="row">
        						<div class="col-md-12">
        							<label for="produc">Producto </label>
        							<select class="producto form-control" name="producto" id="producto" required>
        		 					<option value="">Selecciona el Producto</option>
        	 						</select>
        							<label>Descripción del producto/servicio</label>

        							<textarea class="form-control" id="descripcion" name="descripcion"  required></textarea>
        							<input type="hidden" class="form-control" id="action" name="action"  value="ajax">


        						</div>

        					  </div>

        					  <div class="row">
        						<div class="col-md-6">
        							<label>Cantidad</label>
        							<input type="text" class="form-control" id="cantidad" name="cantidad" required>
        						</div>

        						<div class="col-md-6">
        							<label>Precio unitario</label>
        						  <input type="text" class="form-control" id="precio" name="precio" required>
        						</div>

        					  </div>


        				  </div>
        				  <div class="modal-footer">
        					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        					<button type="submit" class="btn btn-info" >Guardar</button>

        				  </div>
        				</div>
        			  </div>
        			</div>
        	</form>




        <!-- fin del div encabezado -->

  </body>
</html>
