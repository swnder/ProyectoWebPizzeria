<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php require_once "./plantilla/dependencias.php"; ?>
    <title>Acceso Denegado</title>
  </head>
  <body>
    <h1 >FAVOR CONTACTE CON EL ADMINISTRADOR</h1>
    <h1 >SITIO EN CONSTRUCIÓN</h1>
    <div class="container text-center mt-4">
         <img src="./img/construccion.jpg" alt="SITIO EN CONSTRUCIÓN" class="img-fluid border border-success rounded">
         <br>
         <label class="text-danger">ACCESO DENEGADO</label>
         <br>
         <label id="segundos" class="text-success"></label>
    </div>
    <script>
         timer(11000,
             function(seg) {
               $("#segundos").html("En " + seg + " segundos será redirigido...");
             },
             function() {
                 location.href="./cerrarsesion.php";
             }
         );

         function timer(time, update, complete) {
              start = new Date().getTime();
              interval = setInterval(function() {
                 now = time-(new Date().getTime()-start);
                 if( now <= 0) {
                     clearInterval(interval);
                     complete();
                 }else update(Math.floor(now/1000));
             },100);
         }
    </script>


  </body>
</html>
