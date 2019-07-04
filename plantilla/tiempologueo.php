<?php
  <script>
    var tempo = new Number();
    tempo = 60;
    function InicialLogeout(){
      if((tempo-1)>=0){
        var min = parseInt(tempo/60);
        var seg = tempo%60;
        if(min < 10){
          min = '0'+min;
          min = min.substr(0,2);
        }
        if(seg <=9){
          seg = "0"+seg;
        }
        hora = min+':'+seg;
        $("#time_logout").html(hora);
        setTimeout('InicialLogeout()',1000);
          tempo--;
        $(document).mousemove(function(event){
          tempo = 60;
        });
      }else{
        $('#cerrar').click();
        // location.href="/ProyectoWebPizzeria/cerrarsesion.php";
      }
    };
InicialLogeout();
  </script>


 ?>
