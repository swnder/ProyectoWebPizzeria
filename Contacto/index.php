<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8"/>
<link rel="stylesheet" href="../bt/bootstrap.min.css">
<link rel="stylesheet" href="../css/misestilos1.css">
<script src="../bt/bootstrap.min.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.js"></script>

<link rel="icon" href="../img/pizzeria.ico"/>
<title>Envio de Correo</title>
<?php
		 if (!isset($_GET["accion"])){
					header("Location: malaidea.php");
		 }
?>


<link href="styles.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400' rel='stylesheet' type='text/css'>
</head>

<body>

<!-- formulario de contacto -->
<div class="d-flex justify-content-center" >


	<form action="envia.php" method="post" id="row" class="form-consulta mt-5">
		<div class="form-group">
			<div class="col-12 col-md-12">
					<label class="font-weight-bold text-white">NOMBRE Y APELLIDO: <span>*</span>
					</label>
					<input type="text" name="nombre" placeholder="Nombre y apellido" class="campo-form" required autofocus>
					<label class="font-weight-bold text-white">EMAIL: <span>*</span>

					</label>
					<input type="email" name="email" placeholder="Email" class="campo-form" required>
					<label for="consulta" class="font-weight-bold text-white">CONSULTA:

					</label>
					<textarea name="consulta" class="campo-form"></textarea>
		</div>
		<div class="col-12 cols-md-4">
			<input type="submit" value="Enviar" class="btn-form font-weight-bold text-white">
			<button type="button"  class="btn-form font-weight-bold text-white" ><a href="../forms/Contactos_lista.php">Cancelar</a></button>
		</div>



			</div>
	</form>

<!-- formulario -->

</div>
</body>
</html>
