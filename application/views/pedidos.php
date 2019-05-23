<?php
    //lista de pedidos
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $modulo ?> | <?php echo $descripcion?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--Link css-->
    <?php include("incluidos/css.php");?>

    <!--Datatables css-->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <!-- Alertify-->
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>

    <!-- 
        RTL version
    -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.rtl.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.rtl.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.rtl.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.rtl.min.css"/>

</head>

<body>

    <!--Barra lateral-->
    <?php include("incluidos/aside.php") ?>

        <div class="all-content-wrapper">

    <!--Menú-->
    <?php include("incluidos/menu.php") ?>
    
    <!--Menú móvil-->
    <?php include("incluidos/menu.movil.php") ?>

    <?php include("incluidos/menu.movi.fin.php") ?>
    </div>


    <?php
        $atributos = array("id"=>"formapedidos", "name"=>"formapedidos");
        echo form_open('pedidos/agregar/', $atributos);
    ?>

        <div id="example-basic">
            <section>
                <div class="product-list-cart">
                    <div class="product-status-wrap border-pdt-ct">
                        <table id="tabla-pedidos" class="table">
                            <thead>
                                <tr>
                                    <th>Numero</th>
                                    <th>Fecha</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Unidades</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php

                                $i = 0;
                                foreach($lista as $fila){
                                    $i++;
                            ?>
                                <tr>
                                    <td style="color: #000 !important"><?php echo $fila["pkid"];?></td>
                                    <td style="color: #000 !important"><?php echo $fila["fecha"];?></td>
                                    <td style="color: #000 !important"><?php echo $fila["nombre"];?></td>
                                    <td style="color: #000 !important"><?php echo $fila["telefono"];?></td>
                                    <td style="color: #000 !important"><?php echo $fila["correo"];?></td>
                                    <td style="color: #000 !important"><?php echo $fila["unidades"];?></td>
                                    <td style="color: #000 !important"><?php echo number_format($fila["total"],0);?></td>
                    
                    
                                    <td style="color: #000 !important">
                                        <a href="<?php echo site_url('pedidos/editar/'.$fila["pkid"])?>" data-toggle="tooltip" title="Editar" class="pd-setting-ed">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true">Editar</i>
                                        </a>

                                        <a id="a-delete" href="<?php echo site_url('pedidos/eliminar/'.$fila["pkid"])?>" data-toggle="tooltip" title="Eliminar" class="pd-setting-ed">
                                            <i class="fa fa-trash-o" aria-hidden="true">Eliminar</i>
                                        </a>
                                    </td>
                                </tr>
                        <?php } ?>
                            </tbody>    
                        </table>
                    </div>
                </div>
            </section>
        </div>                                    
    </form>

    <!--Pie de página-->    
    <?php include("incluidos/footer.php") ?>
    
    <?php include("incluidos/js.php") ?>
                                        

</body>

</html>

<!--JS datatables-->
<script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

   $(document).ready( function () {
        $('#tabla-pedidos').DataTable();
    });

    $(".pd-setting-ed").click(function(evento){
        evento.preventDefault();
        //capturar el href para enviarlo cuando le de confirmar
        ruta = $(this).attr("href");

        alertify.confirm("¿Esta seguro de eliminar el pedido?",
        function(){
            $(location).attr("href", ruta);
        },
        function(){
            alertify.error('El proceso fue cancelado');
        });
    });

</script>

