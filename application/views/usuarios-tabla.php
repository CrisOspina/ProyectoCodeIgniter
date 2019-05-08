<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de usuarios</title>
</head>
<body>
    <h1><?php echo $titulo;?></h1>
    <table>
        <thead>
            <tr>
                <th>Nombre </th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Perfil</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listado as $fila) 
            {?>
            <tr>
                <td><?php echo $fila["nombre"];?></td>
                <td><?php echo $fila["correo"];?></td>
                <td><?php echo $fila["telefono"];?></td>
                <td><?php echo $fila["perfil"];?></td>
            </tr>
            <?php 
            }?>
        </tbody>
    </table>
</body>
</html>