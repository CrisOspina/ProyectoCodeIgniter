<?php
  /*
    Este mismo formulario nos sirve para ingresar y modificar, la diferencia radica en que si se detecta el id quiere decir que estamos en un proceso de modificación y debemos hacer los siguientes cambios.
    1 - Validar si esta isset id
    2 - traer los datos del registro
    3 - cambiar el form_open para que lo envie a editar
    4 - Cambiar el botón submit
    5 - Agregarle a cada campo el value
    6 - Como estamos modificando el campo clave como esta en sha1 no se puede modificar y es la mejor forma que un administrador del sistema no tenga acceso a las claves de los usuarios.
   */
  $formopen = 'usuarios/nuevo/';
  $txtboton = 'Ingresar nuevo registro';
  $nombre   = "";
  $correo   = "";
  $telefono = "";
  $clave    = "";
  $perfil   = "";

  if (isset($param)) 
  {
    $nombre   = $registro[0]["nombre"];
    $correo   = $registro[0]["correo"];
    $telefono = $registro[0]["telefono"];
    $clave    = $registro[0]["clave"];
    $perfil   = $registro[0]["perfil"];
    $formopen = "usuarios/editar/".$param; 
    $txtboton = "Modificar este registro";
  }

?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Formulario</title>

  </head>
  <body>
  	<br><br>
  	<div class="container">
  		<!--<h1><?php echo site_url('usuarios'); ?></h1>	-->

  		<a href="<?php echo site_url('usuarios');?> title="Click para regresar"><strong>Regresar</strong></a>
  		<?php 
  			if (isset($mensaje)) 
  			{
  				echo "<h4>" . $mensaje. "</h4>";
  			}
        
  		 ?>
  		<br>
  		<?php
  			echo form_open($formopen); 
  		 ?>
  		 <form>
  		 	<strong>Nombre*</strong>
  		 <br>
  		 <input autocomplete="off" type="text" value= "<?php echo $nombre?>" name="nombre" id="nombre" required size="50" maxlength="100">
  		 <br>
  		 <strong>Correo*</strong>
  		 <br>
  		 <input type="correo" value= "<?php echo $correo;?>" name="correo" id="correo" required size="50" maxlength="255">
  		 <br>
  		 <strong>Clave*</strong>
  		 <br>
       <?php
        if(isset($param))
        {
          echo "*****";
        }
        else
        {
          ?>
  		 <input type="password" value= "<?php echo $clave?>" name="clave" id="clave" required size="50" maxlength="10">
       <?php } ?>
       <br>
      
       
  		 <strong>Perfil*</strong>
  		 <br>
		 <select value= "<?php echo $perfil?>" name="perfil" id="perfil" required>
		 	<option value="1"<?php if ($perfil==1) echo "selected";?> >Administrador</option>
		 	<option value="2"<?php if ($perfil==2) echo "selected";?> >Usuario</option>
		 </select>
		 <br><br>
     <button type="submit" name="enviar" id="enviar"><?php echo $txtboton ?></button> 
  		 </form>
  	</div>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>