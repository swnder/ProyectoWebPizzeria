<!DOCTYPE HTML>
<html>
<head>
<title>Contactanos</title>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>

<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<!--Google Fonts-->
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400italic,700italic,400,300,700' rel='stylesheet' type='text/css'>
<!--Google Fonts-->
  <?php include "../plantilla/linktablas.php"; ?>
</head>
<body>
	<?php require_once "../plantilla/CabecerasSegunNivel.php"; ?>

<!--coact start here-->
<div class="container">
	<h1 id="tabla" clas="text-center mt-3  font-weight-bold">Formulario de contactos</h1>
</div>


<div class="contact mt-5" id="row">

	<div class="contact-main">
	<form method="post">
		<h3 class="text-white">Tu correo electrónico</h3>
		<input type="email" placeholder="tu@email.com" class="hola"  name="customer_email" required />

		<h3 class="text-white">Tu nombre</h3>
		<input type="text" placeholder="Tu Nombre" class="hola"  name="customer_name" required />
		<h3 class="text-white">Asunto</h3>
		<input type="text" placeholder="Asunto" class="hola"  name="subject" required />
		<h3 class="text-white">Mensaje</h3>
		<textarea  name="message" placeholder="Escriba su mensaje aquí...." required /></textarea>
		<?php
			if (isset($_POST['send'])){
				include("sendemail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico

				/*Configuracion de variables para enviar el correo*/
				$mail_username="webpizzeria@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
				$mail_userpassword="pizzeria12345";//Tu contraseña de gmail
				$mail_addAddress="webpizzeria@gmail.com";//correo electronico que recibira el mensaje
				$template="email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje

				/*Inicio captura de datos enviados por $_POST para enviar el correo */
				$mail_setFromEmail=$_POST['customer_email'];
				$mail_setFromName=$_POST['customer_name'];
				$txt_message=$_POST['message'];
				$mail_subject=$_POST['subject'];

				sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template);//Enviar el mensaje
			}
		?>
	</div>
	<div class="enviar">
		<div class="contact-check">

		</div>
        <div class="contact-enviar">
		  <input type="submit" value="Enviar mensaje" name="send">
		</div>
		<div class="clear"> </div>
		</form>

</div>

</div>
<div class="container mt-2">
	<div class="copyright" >
		<p id="tabla">Gracias por Contactarnos <a href="http://emprendeya.ml/" target="_blank"> EmprendaYa </a></p>
	</div>
</div>

<!--contact end here-->
</body>
</html>
