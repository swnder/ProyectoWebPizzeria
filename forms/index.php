<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">

        <?php require_once "../plantilla/linktablas.php";?>
        <?php
             if (!isset($_GET["accion"])){
                  header("Location: malaidea.php");
             }
        ?>

    <title>Mala Idea</title>
  </head>
  <body>

    <?php require_once "../plantilla/CabecerasSegunNivel.php"; ?>
<br><br><br><br>



  </body>
</html>
