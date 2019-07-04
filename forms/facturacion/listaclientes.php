<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <title>Clientes</title>
        <link rel="icon" type="image/png" href="imagenes/venta-icono.png"/>

        <link rel="stylesheet" href="css/estilos.css">


    </head>
    <body>
        <?php
            include "conexion.php";

            echo '
                <div style="width:100%; height:100px; position:absolute; background:#2ea6ea; top:0px; left:0px;" class="centrar-div">
                <form name="formBusqueda" action="listaclientes.php" method="get">
                    <label>Buscar:</label>
                    <input type="text" placeholder="Buscar" name="criterio" value="'.$_REQUEST[criterio].'"/>
                    <input type="submit" value="Buscar"/>
                </form>
                </div>
            ';

            echo '
                <div style="width:100%; height:439px; position:absolute; background:#eaf1f1; top:100px; left:0px;">

                    <table align="center" class="bordeFino">
                        <tr class="cabecera-tabla">
                            <td class="bordeColor" width="90px">R.U.C.</td>
                            <td class="bordeColor" width="250px">CLIENTE</td>
                            <td class="bordeColor" width="300px">TELEFONO</td>
                            <td class="bordeColor" width="120px">DIRECCION</td>
                            <td class="bordeColor" width="120px">EMAIL</td>
                            <td class="bordeColor" width="180px">CIUDAD</td>

                            <td class="bordeColor"  width="100px">SELECCIONAR</td>
                        </tr>
            ';
                if (isset($_GET['inicio'])) {
                    $inicio = $_GET['inicio'];
                }else{
                    $inicio = 0;
                }

                //---Obtener el criterio para el filtro
                $criterio = "";
                $txtcriterio = "";
                if (isset($_GET['criterio'])) {
                    if ($_GET["criterio"] != ""){
                        $txtcriterio = $_GET["criterio"];
                        $criterio = " WHERE nombre like '%" . $txtcriterio . "%'";
                    }
                }

                //---Numero de registros por pagina
                $numer_reg = 5;

                $sql = 'SELECT * FROM cliente'.$criterio;
                $resultado = mysql_query($sql);
                $total_registros = mysql_num_rows($resultado);

                $sql = "SELECT * FROM cliente ".$criterio." ORDER BY nombre LIMIT $inicio, $numer_reg";
                $resultado = mysql_query($sql);
                $numero_registros = mysql_num_rows($resultado);
                while($fila = mysql_fetch_array($resultado)){
                    echo "<tr class='detalle-tabla'>";
                        echo "<td class=bordeColor >".$fila['ruc']."</td>";
                        echo "<td class=bordeColor>".$fila['nombre']."</td>";
                        echo "<td class=bordeColor>".$fila['telefono']."</td>";
                        echo "<td class=bordeColor>".$fila['direccion']."</td>";
                        echo "<td class=bordeColor>".$fila['email']."</td>";
                        echo "<td class=bordeColor>".$fila['ciudad']."</td>";
                        echo "<td  class=bordeColor class='boton' align='center'><img src='img/seleccionar.png'></td>";
                    echo "</tr>";
                }

                echo "
                    </table>
                ";

                //---Pagina anterior
                $inicio_pag_ant = $inicio - $numer_reg;
                if ($inicio_pag_ant < 0){  //Estamos situados en la primera pagina
                    $inicio_pag_ant = 0;
                }
                $pag_anterior = "<a href='listaclientes.php?inicio=$inicio_pag_ant&criterio=$txtcriterio'>Pagina anterior</a>";

                //---Pagina siguiente
                $inicio_pag_sig = $inicio + $numer_reg;
                if ($inicio_pag_sig >= $total_registros){
                    $inicio_pag_sig = $inicio_pag_sig - $numer_reg;
                }
                $pag_siguiente = "<a href='listaclientes.php?inicio=$inicio_pag_sig&criterio=$txtcriterio'>Pagina siguiente</a>";

                //---Separador
                $separador = "|";

                //---Barra de navegacion
                $pagi_navegacion = "$pag_anterior $separador $pag_siguiente";

                //---Numero inicial y final de los registros que se visualizan
                if ($total_registros == 0){
                    $reg_inicio = 0;
                }else{
                    $reg_inicio = $inicio + 1;
                }

                $reg_final = $inicio + $numer_reg;
                if ($reg_final > $total_registros){
                    $reg_final = $total_registros;
                }


            echo '
                </div>
                <div style="width:100%; height:100px; position:absolute; background:#217dbb; top:540px; left:0px;" class="centrar-div">
            ';
                    echo "<p class='formato-texto-negrita' align='center'> Registros: " . $reg_inicio . " de " . $reg_final .", de un total de " . $total_registros . "</p>";
                    echo "<p class='formato-texto-normal' align='center'>" . $pagi_navegacion . "</p>";
            echo '
                </div>
            ';
        ?>
    </body>
</html>
