<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" href="../bt/bootstrap.min.css">
<link rel="stylesheet" href="../css/misestilos1.css">
<script src="../bt/bootstrap.min.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.js"></script>
<?php require_once "../plantilla/CabecerasSegunNivel.php"; ?>
<title>Formulario</title>
</head>

<body>
  <div class="d-flex justify-content-center ">
    <div class="container mt-5 gris">
      <div class="d-flex justify-content-center ">
            <h2 class="text-white">Gracias por comunicarse,<br> su mensaje fue enviado correctamente </h2>
      </div>
        <div class="d-flex justify-content-center ">
      <label id="segundos" class="text-white-"></label>

      </div>
      </div>
</div>
</body>



          <script>
               timer(11000,
                   function(seg) {
                     $("#segundos").html("En " + seg + " segundos será redirigido...");
                   },
                   function() {
                       location.href="../forms/Contactos_lista.php";
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
</html>
