<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Titulo ejemplo</title>
  </head>
  <body>
  	<div class="container">
  		<h1><?php echo $titulo;?></h1>
    <a href="<?php echo site_url('usuarios/nuevo');?>" title="Click para crear nuevo registro"><strong>Nuevo registro</strong></a>
 	<a href="<?php echo site_url('principal');?>" title="Click para regresar"><strong>Regresar</strong></a>
	
	<br>
    <table width="90%" cellpadding="5" cellspacing="1" bgcolor="#000000">
        <thead>
            <tr bgcolor="#ccc">
                <th>Nombre </th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Perfil</th>
                <th>Fecha registro</th>
                <th>Fecha modificación</th>
                <th>Opción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listado as $fila) 
            {?>
            <tr bgcolor="#fff">
                <td><?php echo $fila["nombre"];?></td>
                <td><?php echo $fila["correo"];?></td>
                <td><?php echo $fila["telefono"];?></td>
                <td><?php 
                	$texto = "Administrador";
                	if ($fila["perfil"]==2) $texto="Usuario";
                	echo $texto;
                ?></td>
                <td><?php echo $fila["fechaingreso"];?></td>
                <td><?php echo $fila["fechamodificacion"];?></td>
                <td>
                	<a href="<?php echo site_url('usuarios/editar/' .$fila["id"])?>" title="click para modificar">Modificar</a> | <a href="<?php echo site_url('usuarios/eliminar/' .$fila["id"])?>" title="click para modificar">Eliminar</a>
                </td>
            </tr>
            
            <?php 
            }?>
        </tbody>
    </table>	
  	</div>

    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>