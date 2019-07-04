<!DOCTYPE html>
<!--
    AUTOR: Lic. Juan B. Torres B.
    FECHA: Mayo de 2016
 -->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
        <title>Buscar productos</title>
        <link rel="icon" type="image/png" href="img/articulo.png"/>

        <link rel="stylesheet" href="css/estilos.css">
        <script src="js/jquery-2.2.3.min.js" type="text/javascript"></script>

        <script>
            $(document).ready(function(){
                $(".btn").click(function(){
                    $(this).parents("tr").find("td").each(
                        function(indice){
                            switch (indice){
                                case 0:
                                    window.opener.document.getElementById("codbarra").value = $(this).text();
                                    break;
                                case 1:
                                    window.opener.document.getElementById("descripcion").value = $(this).text();
                                    break;
                                case 2:
                                    window.opener.document.getElementById("stock").value = $(this).text();
                                    break;
                                case 3:
                                    window.opener.document.getElementById("preuni").value = $(this).text();
                                    break;
                                case 4:
                                    window.opener.document.getElementById("idarticulo").value = $(this).text();
                                    break;
                            }
                        }
                    );
                    window.opener.calcularST();
                    window.opener.document.getElementById("cantidad").focus();
                    window.close();
                });
            });
        </script>
        <style>
            .btn {
                cursor:pointer;
                color:Blue;
            }
        </style>

    </head>
    <body>
        <?php
            include "conexion.php";
            $conex = conexion();
            //---Obtener el criterio para el filtro
            $criterio = "";
            $txtcriterio = "";
            if (isset($_GET['criterio'])) {
                if ($_GET["criterio"] != ""){
                    $txtcriterio = $_GET["criterio"];
                    $criterio = " WHERE descripcion like '%" . $txtcriterio . "%'";
                }
            }
            echo '
                <div style="width:100%; height:30px; position:absolute; background:#3f51b5; top:0px; left:0px;" class="centrar-div">
                <form name="formBusqueda" action="buscararticulos.php" method="get">
                    <label class="formato-texto-negrita">Buscar descripción:</label>
                    <input class="formato-texto-negrita" type="text" name="criterio" value="'.$txtcriterio.'"/>
                    <input type="submit" value="Buscar"/>
                </form>
                </div>
            ';

            echo '
                <div style="width:100%; height:339px; position:absolute; background:#eaf1f1; top:30px; left:0px;">
                    <br><br>
                    <table align="center" id=bordeFino>
                        <tr class="cabecera-tabla">
                            <td id=bordeFino width="120px">NOMBRE</td>
                            <td id=bordeFino width="450px">CATEGORIA</td>
                            <td id=bordeFino width="60px">MARCA</td>
                            <td id=bordeFino width="100px">PRECIO</td>
                            <td id=bordeFino width="100px">TAMANO</td>
                            <td id=bordeFino width="100px">STOCK</td>
                            <td id=bordeFino width="50px" align="center">ID</td>
                            <td id=bordeFino  width="100px">SELECCIONAR</td>
                        </tr>
            ';
                if (isset($_GET['inicio'])) {
                    $inicio = $_GET['inicio'];
                }else{
                    $inicio = 0;
                }

                //---Numero de registros por pagina
                $numer_reg = 10;

                $sql = 'SELECT * FROM producto'.$criterio;
                $resultado = mysqli_query($conex, $sql);
                $total_registros = mysqli_num_rows($resultado);

                $sql = "SELECT * FROM producto ".$criterio." ORDER BY nombre LIMIT $inicio, $numer_reg";
                $resultado = mysqli_query($conex, $sql);
                $numero_registros = mysqli_num_rows($resultado);
                foreach ($resultado as $fila) {
                    echo "<tr class='detalle-tabla'>";
                        echo "<td id=bordeFino>".$fila['nombre']."</td>";
                        echo "<td id=bordeFino>".$fila['categoria']."</td>";
                        echo "<td id=bordeFino align=right>".$fila['marca']."</td>";
                        echo "<td id=bordeFino align=right>".$fila['precio']."</td>";
                        echo "<td id=bordeFino align=right>".$fila['tamano']."</td>";
                        echo "<td id=bordeFino align=right>".$fila['stock']."</td>";
                        echo "<td id=bordeFino align=center>".$fila['id']."</td>";
                        echo "<td id=bordeFino class='btn' align='center'><img src='img/seleccionar.png'></td>";
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
                $pag_anterior = "<a href='buscararticulos.php?inicio=$inicio_pag_ant&criterio=$txtcriterio'>Pagina anterior</a>";

                //---Pagina siguiente
                $inicio_pag_sig = $inicio + $numer_reg;
                if ($inicio_pag_sig >= $total_registros){
                    $inicio_pag_sig = $inicio_pag_sig - $numer_reg;
                }
                $pag_siguiente = "<a href='buscararticulos.php?inicio=$inicio_pag_sig&criterio=$txtcriterio'>Pagina siguiente</a>";

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
                <div style="width:100%; height:110px; position:absolute; background:#3f51b5; top:370px; left:0px;" class="centrar-div">
                    <br>
            ';
                    echo "<p class='formato-texto-negrita' align='center'> Registros: " . $reg_inicio . " de " . $reg_final .", de un total de " . $total_registros . "</p>";
                    echo "<p class='formato-texto-normal' align='center'>" . $pagi_navegacion . "</p>";
            echo '
                </div>
            ';
        ?>
    </body>
</html>
