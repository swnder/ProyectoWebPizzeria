<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <title>Registo de Compra</title>
        <link rel="icon" href="../img/pizzeria.ico">

        <link rel="stylesheet" href="../css/estilos.css">
        <link rel="stylesheet" href="../css/misestilos1.css">
        <link rel="stylesheet" href="../bt/bootstrap.min.css">
        <link rel="stylesheet" href="../css/tabladetalle.css">
        <link rel="stylesheet" href="../css/alertify.core.css">
        <script src="../bt/bootstrap.min.js"></script>
        <!-- Tema estandar -->
        <link rel="stylesheet" href="../css/themes/alertify.default.css">
        <script src="../js/alertify.min.js"></script>


        <!-- Formatear la tabla Detalles -->

    </head>
    <body>
        <?php
            include "conexion.php";
            $conex = conexion();
            //Genera numero de factura
            $sql = "SELECT MAX(numfactura) AS num FROM ventacabecera";
            $resultado = mysqli_query($conex, $sql);
            while($fila = mysqli_fetch_array($resultado)){
                $nfac = $fila["num"];
            }
            $nfac = $nfac + 1;

            //MOSTRAR MENSAJE DE FACTURA GUARDADA CON EXITO
            if (isset($_GET['exito'])){
                echo "
                    <script>
                        alertify.custom = alertify.extend('custom');
                        alertify.custom('La factura de venta fue guardada con éxito!!!');
                    </script>
                ";
            }
        ?>
<div class="container gris">
  <p class="titulo1">Compras</p>
  <div class="row" >
     <div class="col">
        <form name="formVenta" method="post" action="guardarventa.php">
        <!-- <div class="container" style="width:100%; height:180px; position:absolute; background:#03a9f4; top:0px; left:0px;" id="divCliente"> -->
        <div class="form-group row mt-3">
             <div class="col-12 col-md-12">
               <div class="container"  id="divCliente">

                     <div class="table-responsive">

                   <table align="center" class="table table-striped  table-hover formato-texto-negrita " id="tablatransparente">
                     <tr>
                    <td id="tablatransparente">Nº DE FACTURA:</td>
                    <td id="tablatransparente"><input type="text" id="numfactura" name="numfactura" size=40 readonly class="formato-texto-normal" value="<?php echo $nfac ?>"></td>
                    <td id="tablatransparente">FECHA:</td>
                    <td id="tablatransparente"><input type="text" id="fecha" id="fecha" name="fecha" size=40 readonly class="formato-texto-normal" value="<?php echo date('d/m/Y') ?>"></td>
                </tr>
                <tr>
                    <td id="tablatransparente">Proveedor:</td>
                    <td id="tablatransparente"><input type="text" id="razonsocial" size=40 readonly class="formato-texto-normal"></td>
                    <td id="tablatransparente">DIRECCIÓN:</td>
                    <td id="tablatransparente"><input type="text" id="direccion" size=40 readonly></td>
                  </tr>
                <tr>
                    <td id="tablatransparente">R.U.C./C.I:</td>
                    <td id="tablatransparente"><input type="text" id="ruc" size=40 readonly></td>
                    <td id="tablatransparente">CIUDAD:</td>
                    <td id="tablatransparente"><input type="text" id="ciudad" size=40 readonly></td>
                </tr>
                <tr>
                    <td id="tablatransparente">TELÉFONO:</td>
                    <td id="tablatransparente"><input type="text" id="telefono" size=40 readonly></td>
                    <td id="tablatransparente">ID Proveedor:</td>
                    <td id="tablatransparente"><input type="text" id="idcliente" name="idcliente" size=40 readonly></td>
                </tr>
            </table>
            </div>
            <!-- termina tabla responsiba -->

        </div>
        </div>
        </div>
        <!-- primera fila -->
        <div class="form-group row mt-3">
             <div class="col-12 col-md-12">
               <input type="button" value="Seleccionar cliente" id="icono-cliente" class="botonGrande" onClick="buscarCliente();"/>

               </div>
        </div>
        <!-- segunda fila -->

        <!-- <div style="width:100%; height:409px; position:absolute; background:#eaf1f1; top:180px; left:0px;"> -->
        <div class"container gris">
            <br>
            <!-- DIV para el borde de los datos del Articulo -->
            <div style="width:1140px; height:80px; margin:0 auto 0 auto; border:solid 1px">
            <table align="center" class="formato-texto-negrita" id="tablatransparente">
                <tr>
                    <td id="tablatransparente">COD. BARRA:</td>
                    <td id="tablatransparente"><input type="text" id="codbarra" size=40 readonly class="formato-texto-normal"></td>
                    <td id="tablatransparente">CANTIDAD:</td>
                    <td id="tablatransparente"><input type="number" id="cantidad" size=40 autofocus value="1" onKeyUp="calcularST()"></td>
                    <input type="hidden" id="stock">
                    <td id="tablatransparente" rowspan=3><button type="button" id="icono-articulo" class="botonGrandeVerde" onClick="buscarArticulo();">Seleccionar<br>artículo</button></td>
                    <td id="tablatransparente" rowspan=3><button type="button" id="icono-agregar" class="botonGrandeRojo" onClick="agregarArticulo();">Agregar<br>artículo</button></td>
                </tr>
                <tr>
                    <td id="tablatransparente">DESCRIPCIÓN:</td>
                    <td id="tablatransparente"><input type="text" id="descripcion" size=40 readonly></td>
                    <td id="tablatransparente">PRE. UNI.:</td>
                    <td id="tablatransparente"><input type="text" id="preuni" size=40 readonly></td>
                </tr>
                <tr>
                    <td id="tablatransparente">ID ARTÍCULO:</td>
                    <td id="tablatransparente"><input type="text" id="idarticulo" size=40 readonly></td>
                    <td id="tablatransparente">SUBTOTAL:</td>
                    <td id="tablatransparente"><input type="text" id="subtotal" size=40 readonly></td>
                </tr>
            </table>
            </div>

            <!-- INICIO TABLA DE DETALLES -->
            <br>
            <div class="container" id="table-scroll">
                <div id="fixedY">
                    <table>
                        <thead>
                            <tr>
                                <th width="60px">ID ART.</th>
                                <th width="130px">COD. BARRA</th>
                                <th width="500px">DESCRIPCIÓN</th>
                                <th width="50px">CANT.</th>
                                <th width="80px">PRE. UNI.</th>
                                <th width="80px">SUBTOTAL</th>
                                <th width="100px">QUITAR ART.</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="container" id="cuerpoDatos">
                    <div id="fixedX"></div>

                    <div id="nofixedX">
                        <table id="TablaDetalle">
                            <tbody class=formato-texto-normal>
                                <tr>
                                    <td width="60px"></td>
                                    <td width="130px"></td>
                                    <td width="250px"></td>
                                    <td width="50px"></td>
                                    <td width="80px"></td>
                                    <td width="80px"></td>
                                    <td width="100px"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- FIN TABLA DE DETALLES -->

        </div>

          <!-- <div style="width:100%; height:100px; position:absolute; background:#217dbb; top:540px; left:0px;"> -->
        <div class="container">
            <table align="center" id="tablatransparente">
                <tr>
                    <td id="tablatransparente"><label style="font-family:Tahoma;font-size:40px;font-weight: bold;">TOTAL A PAGAR:
                        <input style="font-family:Tahoma;font-size:40px;font-weight:bold;background-color:yellow;text-align:right" type="text" id="totalpagar" name="totalpagar" size=10 readonly/>
                    </label></td>
                    <td id="tablatransparente" width=30></td>
                    <td id="tablatransparente">
                        <button type="button" id="icono-guardar" class="botonGrandeVerde" onClick="validar();">Guardar venta</button>
                    </td>
                    <td id="tablatransparente" width=30></td>
                    <td id="tablatransparente">
                        <button type="button" id="icono-cancelar" class="botonGrandeRojo" onClick="cancelarVenta();">Cancelar venta</button>
                    </td>
                </tr>
            </table>
            <!-- CAMPO PARA ALMACENAR EL DETALLE DE LA VENTA. AL HACER CLIC EN Guardar Venta -->
            <input type="hidden" id="detalle" name="detalle"/>
        </div>
        </form>

  </div>
  </div>
  </div>








        <script type="text/javascript">
            function buscarCliente(){
                window.open('buscarclientes.php','','toolbar=no, status=no, scrollbars=yes,location=no,menubar=no,directories=no,width=1160,height=480');
            }
            //---------------------------------------------------------------
            function buscarArticulo(){
                window.open('buscararticulos.php','','toolbar=no, status=no, scrollbars=yes,location=no,menubar=no,directories=no,width=980,height=480');
            }
            //---------------------------------------------------------------
            function calcularST(){
                can = document.getElementById("cantidad").value;
                pre = document.getElementById("preuni").value;
                if (can == "") {
                     alertify.error("ERROR: La cantidad debe ser un valor numérico");
                     document.getElementById("subtotal").value = "";
                }else{
                    if (pre == ""){
                        alertify.error("ERROR: No se cuenta con el precio del artículo");
                    }else{
                        pre = pre.replace(".", "");
                        pre = pre.replace(".", "");
                        sub = parseInt(can) * parseInt(pre);
                        sub = sub.toLocaleString();
                        document.getElementById("subtotal").value = sub;
                    }
                }
            }
            //---------------------------------------------------------------
            function agregarArticulo(){
                canti = document.getElementById("cantidad").value;
                stock = document.getElementById("stock").value;
                pre = document.getElementById("preuni").value;
                if (canti == "") {
                     alertify.error("ERROR: La cantidad debe ser un valor numérico");
                     document.getElementById("subtotal").value = "";
                     document.getElementById("cantidad").focus();
                }else{
                    if (pre == ""){
                        alertify.error("ERROR: No se cuenta con el precio del artículo");
                    }else if (parseInt(canti) > parseInt(stock)){
                        alertify.set({
                            labels: {
                                ok     : "Aceptar",
                            }
                         });
                        alertify.alert("La cantidad ingresada supera el stock del artículo <br/> Stock disponible: " + stock);
                        document.getElementById("cantidad").focus();
                    }else{
                        calcularST();
                        agregarFila();
                        calcularTotal();
                        limpiarCampos();
                    }
                }
            }
            //---------------------------------------------------------------
            function agregarFila() {
                var tabla = document.getElementById("TablaDetalle");
                var totalFilas = tabla.rows.length;
                var fila = tabla.insertRow(totalFilas);

                var celda0 = fila.insertCell(0);
                var elemento0 = document.createElement("label");
                elemento0.innerHTML = document.getElementById("idarticulo").value;
                celda0.setAttribute("align", "center");
                celda0.appendChild(elemento0).align;

                var celda1 = fila.insertCell(1);
                var elemento1 = document.createElement("label");
                elemento1.innerHTML = document.getElementById("codbarra").value;
                celda1.appendChild(elemento1);

                var celda2 = fila.insertCell(2);
                var elemento2 = document.createElement("label");
                elemento2.innerHTML = document.getElementById("descripcion").value;
                celda2.appendChild(elemento2);

                var celda3 = fila.insertCell(3);
                var elemento3 = document.createElement("label");
                elemento3.innerHTML = document.getElementById("cantidad").value;
                celda3.setAttribute("align", "right");
                celda3.appendChild(elemento3);

                var celda4 = fila.insertCell(4);
                var elemento4 = document.createElement("label");
                elemento4.innerHTML = document.getElementById("preuni").value;
                celda4.setAttribute("align", "right");
                celda4.appendChild(elemento4);

                var celda5 = fila.insertCell(5);
                var elemento5 = document.createElement("label");
                elemento5.innerHTML = document.getElementById("subtotal").value;
                celda5.setAttribute("align", "right");
                celda5.appendChild(elemento5);

                var celda6 = fila.insertCell(6);
                var elemento6 = document.createElement("img");
                elemento6.setAttribute("src", "img/borrar.png");
                celda6.setAttribute("align", "center");
                celda6.setAttribute("class", "borra");
                celda6.setAttribute("onClick", "quitarArticulo();");
                celda6.appendChild(elemento6);
            }
            //---------------------------------------------------------------
            function calcularTotal() {
                var tabla = document.getElementById("TablaDetalle");
                var canFilas = tabla.rows.length;
                var tot = 0;
                //Recorre las filas de la tabla
                for(var i=1; i<canFilas; i++) {
                    var subtot = tabla.rows[i].cells[5].innerHTML;
                    subtot = subtot.replace(/\D/g,'');  //Extrae solo los numeros de la cadena
                    tot = tot + parseInt(subtot);
                }
                document.getElementById("totalpagar").value = tot.toLocaleString();
            }
            //---------------------------------------------------------------
            function limpiarCampos() {
                document.getElementById("codbarra").value = "";
                document.getElementById("descripcion").value = "";
                document.getElementById("idarticulo").value = "";
                document.getElementById("cantidad").value = "1";
                document.getElementById("preuni").value = "";
                document.getElementById("subtotal").value = "";
                document.getElementById("cantidad").focus();
            }
            //----------------------------------------------------------------
            function quitarArticulo() {
                //Obtener el numero de fila en donde se hizo clic
                var fi=0;
                var filas = document.getElementById('TablaDetalle').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
                for (i = 1; i < filas.length; i++) {
                    filas[i].onclick = function() {
                        fi = this.rowIndex;
                        document.getElementById("TablaDetalle").deleteRow(fi);
                        alertify.success("Se ha quitado el artículo");
                        calcularTotal();
                    }
                }
            }
            //---------------------------------------------------------------
            function cancelarVenta() {
                var tot = document.getElementById("totalpagar").value;
                if (tot == "" || tot == "0"){
                    window.location.reload(); //Recargar pagina
                }else{
                    alertify.set({
                        labels: {
                            ok     : "Aceptar",
                            cancel : "Cancelar"
                        },
                        buttonReverse: true,
                        buttonFocus: "cancel"
                     });
                    alertify.confirm("¿Desea cancelar la factura?", function (e) {
                        if (e) {
                            window.location.reload(); //Recargar pagina
                        }
                    });
                }
            }
            //---------------------------------------------------------------
            function validar() {
                var cliente = document.getElementById("razonsocial").value;
                var total = document.getElementById("totalpagar").value;
                if (cliente == ""){
                    alertify.alert("No se puede guardar la factura!!!<br/>Seleccione un Cliente!!!");
                }else if (total == "" || total == "0"){
                    alertify.alert("No se puede guardar la factura!!!<br/>Debe seleccionar por lo menos un Artículo!!!");
                }else{
                    detalleArray();
                    document.forms["formVenta"].submit();
                }
            }
            //---------------------------------------------------------------
            function detalleArray() {
                //Esta funcion pasa los datos del detalle a un array
                var tabla = document.getElementById("TablaDetalle");
                var canFilas = tabla.rows.length;
                var array = new Array();
                //Recorre las filas de la tabla
                var pos=0;
                //Pasar los valores de la tabla detalle a un Array
                for(var i=1; i<canFilas; i++) {
                    idArticulo = tabla.rows[i].cells[0].innerHTML;
                    idArticulo = idArticulo.replace('<label>', "");
                    idArticulo = idArticulo.replace('</label>', "");
                    array[pos] = idArticulo;
                    pos = pos + 1;

                    cantidad = tabla.rows[i].cells[3].innerHTML;
                    cantidad = cantidad.replace('<label>', "");
                    cantidad = cantidad.replace('</label>', "");
                    array[pos] = cantidad;
                    pos = pos + 1;

                    preuni = tabla.rows[i].cells[4].innerHTML;
                    preuni = preuni.replace('<label>', "");
                    preuni = preuni.replace('</label>', "");
                    array[pos] = preuni.replace(/\D/g,'');
                    pos = pos + 1;

                    subtot = tabla.rows[i].cells[5].innerHTML;
                    subtot = subtot.replace('<label>', "");
                    subtot = subtot.replace('</label>', "");
                    array[pos] = subtot.replace(/\D/g,'');
                    pos = pos + 1;
                }
                //Convertir el array en String y almacenar en un campo oculto
                document.getElementById("detalle").value=array.toString();
            }
            //---------------------------------------------------------------
        </script>
    </body>
</html>
