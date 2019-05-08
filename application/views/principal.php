<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Bienvenidos | Principal del sistema</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--Link css-->
    <?php include("incluidos/css.php");?>

</head>

<body>

    <!--Barra lateral-->
    <?php include("incluidos/aside.php") ?>

        <div class="all-content-wrapper">

    <!--Menú-->
    <?php include("incluidos/menu.php") ?>
    
    <!--Menú móvil-->
    <?php include("incluidos/menu.movil.php") ?>

        </div>

    <!--Menu móvil parte final-->
    <?php include("incluidos/menu.movi.fin.php") ?>

    <!--Resumen principal-->
    <?php include("incluidos/resumen.php") ?>
      
    <!--Grafica prinical del sistema-->
    <?php include("incluidos/graficas.php") ?>
      
      
    <!--Bloques de trafico-->
    <?php include("incluidos/trafico.php") ?>    

    <!--Bloques de productos-->
    <?php include("incluidos/productos.php") ?>
        
    <!--Bloques de ventas-->
    <?php include("incluidos/ventas.php") ?>

    <!--Calendario-->
    <?php include("incluidos/calendario.php") ?>

    <!--Pie de página-->    
    <?php include("incluidos/footer.php") ?>
        
       
    </div>
    
    <?php include("incluidos/js.php") ?>
</body>

</html>