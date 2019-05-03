toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-bottom-full-width",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "500",
  "timeOut": "3000",
  "extendedTimeOut": "500",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "hide"
};
//--------------------------------------------------------------------------
//Toma todas las variables de url y las carga en un array
//Almacena el nombre de cada variable con su valor
function getUrlVariables(){
  var vars = [], hash;
  var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
  for(var i = 0; i < hashes.length; i++){
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
  }
  return vars;
}
//--------------------------------------------------------------------------
function verificarSesion(usuValido) {
  if (usuValido != "si"){
    $("#seguridad").show();
    $("#menu").hide();
    $("#container").hide();
    $("#carrusel3").hide();
    timer(7000, // milisegundos
        function(seg) {
          $("#segundos").html("En " + seg + " segundos será redirigido...");
        },
        function() {
          location.href="/ProyectoWebPizzeria/index.php";
        }
    );
  }
}

//--------------------------------------------------------------------------
function timer(time,update,complete) {
    var start = new Date().getTime();
    var interval = setInterval(function() {
        var now = time-(new Date().getTime()-start);
        if( now <= 0) {
            clearInterval(interval);
            complete();
        }
        else update(Math.floor(now/1000));
    },100);
}
//--------------------------------------------------------------------------
function inactividad() {
        //(function ($) {
            //Define default
            var
                docTimeout = 600000;
            /*
            Handle raised idle/active events
            */
            $(document).on("idle.idleTimer", function (event, elem, obj) {
                window.location.href = "/ProyectoWebPizzeria/cerrarsesion.php";
            });
            $(document).idleTimer({
              timeout: docTimeout,
              timerSyncId: "document-timer-demo"
            });
        //})
        //(jQuery);
}
