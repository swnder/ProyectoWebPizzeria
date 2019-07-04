<?php
	if (!isset($_SESSION)) session_start();
	if(!$_POST) exit;

	//PHP Mailer
	require_once(dirname(__FILE__)."/tools/phpmailer/PHPMailerAutoload.php");

		$toName = "Sistema Pizzeria";//Ingresa tu nombre o nombre de tu empresa
		$toAddress = "webpizzeria@gmail.com";//Ingresa tu correo electrónico



	//Captura los campos del formulario
	$name = 	$_POST["name"];
	$email = 	$_POST["email"];
	$phone = 	$_POST["phone"];
	$subject = 	$_POST["subject"];
	$message = 	$_POST["message"];

	//Captcha
	$session_captcha = $_SESSION["captcha"];
	//Valida el formulario
	$verify = isset($_POST["verify"]) ? $_POST["verify"] : "";
	$error = "";

	if ($verify!=$session_captcha) {
		//Valida el captcha
		$error = "El valor escrito en el captcha es incorrecto.";
	} else {
		//Valida los campos del formulario
		if(trim($name)=="") {
			$error = "Su nombre es requerido.";
		} elseif(trim($email)=="") {
			$error = "su e-mail es requerido.";
		} elseif(!isEmail($email)) {
			$error = "Ha introducido una dirección de correo electrónico no válida.";
		} elseif(trim($phone)=="") {
			$error = "su numero de telefono es requerido.";
		} elseif(!is_numeric($phone)) {
			$error = "Su número de teléfono sólo puede contener dígitos.";
		} elseif(trim($message)=="") {
			$error = "Debe introducir un mensaje para enviar.";
		}

		//Envia el mensaje via e-mail
		if (!strlen($error)) {
			if(get_magic_quotes_gpc()) {
				$message = stripslashes($message);
			}

			$email_subject = "Soporte de contacto: ".$subject;

			$email_body = "<p>Ha sido contactado por <b>".$name."</b> con respecto a <b>".$subject."</b>, Quien pasó la verificación y el mensaje es el siguiente.</p>
							<p>----------</p>
							<p>".preg_replace("/[\r\n]/i", "<br />", $message)."</p>
							<p>----------</p>
							<p>
								E-mail: <a href=\"mailto:".$email."\">".$email."</a>
								<br />Telefono: <b>".$phone."</b>
							</p>";

			$objmail = new PHPMailer();

			//Usar esta linea si tu quieres usar la funcion mail de PHP
			$objmail->IsMail();

			//Usar el siguiente codigo si quieres usar el metodo  SMTP  para enviar el mail
			/*
			$objmail->IsSMTP();
			$objmail->SMTPAuth = true;
			$objmail->Host = "mail.yourdomain.com";
			$objmail->Port = 587;	// Puedes remover esta linea sino necesitas establecer un puerto smtp
			$objmail->Username = "example@yourdomain.com";
			$objmail->Password = "email_address_password";
			*/

			$objmail->From = $email;
			$objmail->FromName = $name;
			$objmail->AddAddress($toAddress, $toName);
			$objmail->AddReplyTo($email, $name);
			$objmail->Subject = $email_subject;
			$objmail->MsgHTML($email_body);
			if(!$objmail->Send()) {
				$error = "Error al enviar el mensaje : ".$objmail->ErrorInfo;
			}
		}


	}

	//Result
	if ($error!="") {
		echo $error."<script>notificationReady('fail');</script>";
	} else {
		echo "Gracias <strong>".$name."</strong>, Su mensaje ha sido enviado a nosotros.
			  <script>notificationReady('success');</script>";
	}

	//Verifica la dirección de correo electrónico
	function isEmail($value) {
		return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $value);
	}


?>
