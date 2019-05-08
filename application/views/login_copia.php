<!DOCTYPE html>
<html>
<head>
	<title>Acceso al sistema</title>
</head>
<body>
	<h1>Ingrese login y clave</h1>
	
<?php echo form_open('login/acceso/');?>	

	<!--Formulario-->
	<form action="">
		<strong>Usuario:</strong>
		<br><hr>
		<input type="email" name="correo" id="correo" placeholder="Digite su correo" required maxlength="100">
		<br>
		<strong>Contraseña:</strong>
		<hr>
		<input type="password" name="clave" id="clave" placeholder="Digite contraseña" required maxlength="20">
		<br><hr>
		<button type="submit" name="enviar" id="enviar">Acceder al sistema</button>
	</form>

</body>
</html>