<!DOCTYPE html>
<html lang="es" dir="ltr">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="theme-color" content="black">
          <title>Oops</title>
          <link rel="icon" href="../img/alien.png"/>

          <!-- CSS REQUERIDOS -->
          <!-- Bootstrap -->
          <link rel="stylesheet" href="../bt/bootstrap.min.css">

          <!-- JS REQUERIDOS -->
          <!-- JQuery -->
          <script src="../js/jquery-3.3.1.min.js"></script>
          <!-- Boostrap -->
          <script src="../bt/bootstrap.min.js"></script>

     </head>
     <body style="background-color:black;">
          <div class="container text-center mt-4">
               <img src="../img/mala.jpg" alt="Mala Idea" class="img-fluid border border-success rounded">
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
                       location.href="../#_lista.php";
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
