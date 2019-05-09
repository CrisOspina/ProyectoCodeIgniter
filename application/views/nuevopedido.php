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
            <h3>Shopping Cart</h3>
            <section>
                <h3 class="product-cart-dn">Shopping</h3>
                <div class="product-list-cart">
                    <div class="product-status-wrap border-pdt-ct">
                        <table>
                            <tr>
                                <th>Imagen</th>
                                <th>Referencia</th>
                                <th>Cantidad</th>
                                <th>Valor</th>
                                <th>Impuestos</th>
                                <th>Subtotal</th>
                                <th>Opciones</th>
                            </tr>

                        <?php 
                            //Contador
                            $i = 0;
                            foreach($listaproductos as $fila) {
                                $i++
                        ?>
                            <tr>
                                <td>
                                    <?php
                                        if($fila["foto1"]<>"") 
                                        {?>
                                            <img src="<?php echo base_url();?>/assets/uploads/productos/<?php echo $fila["foto1"] ?>" style="width: 100px;">
                                       <?php } ?>
                                    
                                </td>

                                <td>
                                    <h3><?php echo $fila["ref"]?></h3>
                                    <p><?php echo $fila["nombre"]?></p>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="cant_<?php echo $i;?>" id="cant_<?php echo $i;?>" maxlength="4" style="width: 60px" onblur="calcular('<?php echo $i?>')">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="valor_<?php echo $i;?>" value="<?php echo $fila["precio"]?>" id="valor_<?php echo $i;?>" maxlength="10" style="width: 100px" onblur="calcular('<?php echo $i?>')">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="impuesto_<?php echo $i;?>" value="<?php echo $fila["iva"]?>" id="impuesto_<?php echo $i;?>" maxlength="2" style="width: 60px" onblur="calcular('<?php echo $i?>')">
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="subtotal_<?php echo $i;?>" id="subtotal_<?php echo $i;?>" readonly style="width: 200px; color: #000 !important " >
                                </td>
                                <td>
                                    <button onclick="agregar('<?php echo $i;?>')" type="button" data-toggle="tooltip" title="Adicionar" class="pd-setting-ed">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>

                                    <button data-toggle="tooltip" title="Trash" class="pd-setting-ed">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>

                                    <input type="hidden" name="ref_<?php echo $i?>" id="ref_<?php echo $i?>" value="<?php echo $fila["ref"]?>">

                                    <input type="hidden" name="token_<?php echo $i?>" id="token_<?php echo $i?>" value="<?php echo $token?>">

                                    <span id="mensaje_<?php echo $i;?>"></span>
                                </td>
                            </tr>
                        <?php } ?>
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

<script type="text/javascript">
    /*
        Funciones que permiten calcular el subtotal y funciones de agregar y eliminar productos del pedido para el calcular tomamos la posición para agregar y eliminar usamos AJAX para realizar el proceso en modo en paralelo                                    
    */

    function calcular(pos) {
        //capturar los id de cant, iva, precio y subtotal para realizar operaciones.
        $("#subtotal_" + pos).val(0);
        let cant   = $("#cant_" + pos).val();
        let precio = $("#valor_" + pos).val();
        let iva    = $("#impuesto_" + pos).val();

        if(cant > 0 && precio > 0 && iva >= 0) {
            subtotal = eval(cant * precio) + (cant * precio * (iva / 100));
        }

        $("#subtotal_" + pos).val(subtotal);
    }                                            

    //Agregar = captura la ruta desde el action del formulario y pasamos los parámetros al controlador pedidos agregar.
    //El método agregar recibira un tipo, si el uno que agregue y si es dos que elimine.
    //El tipo se pasa de acuerdo a la funcion que se invoque, en este caso agregar sera 1 y eliminar será 2.

    function agregar(pos) {

        let ruta = $("#formapedidos").attr("action");
        let tipo = 1;
        //Los parametros los vamos a pasar en un array
        let cant     = $("#cant_" + pos).val();
        let precio   = $("#valor_" + pos).val();
        let iva      = $("#impuesto_" + pos).val();
        let subtotal = $("#subtotal_" + pos).val();
        let ref      = $("#ref_" + pos).val();
        let token    = $("#token_" + pos).val();

        if(subtotal <= 0){
            mensaje = "<span class='btn btn-danger'>El subtotal debe ser mayor de cero</span>";
            $("#mensaje_" + pos).html(mensaje);
            $("#mensaje_" + pos).fadeOut(5000);
            return;
        }

        //invocar la funcion ajax que nos permite cargar el controlador y la función que esta en el action del formulario (pedidos/agregar).

        //Ajax = procesos asincronicos
        /* 
            * BeforeAfter() = antes de enviar -------- envia
            * Success = cuando se esta enviando - - calculos, etc
            * Error = errores que se pueden presentar (error de sintaxis-ruta caida)
                    metodo transportar, status, error

            ** Ajax pide los siguientes parametros
            * url
            * type 
            * data

            utiliza el protocolo Xmlhttprequest= coger datos y transmitirlo
            
        */

        //1 - preparar los datos para ajax
        //los datos se deben pasar como un array
        //2- la ruta o url ya esta capturada en php
        //3- definir el método de transporto post o get
        //4 - invocar el ajax

        let parametros = {
            "cant": cant,
            "precio":precio,
            "iva": iva,
            "subtotal": subtotal,
            "ref": ref,
            "token": token,
            "tipo": tipo
        };

        type = "POST";

        $.ajax({
            data: parametros,
            url: ruta,
            type: type,
            beforesend: function(){
                $("#mensaje_" + pos).show();
                $("#mensaje_" + pos).html("<span class='btn btn-danger'>Procesando...</span>");
            },
            //Siempre devuelve una respuesta, en este caso por nemotecnia se llama response
            success: function(response){
                $("#mensaje_" + pos).show();
                if(response == 1) {
                    txt = 'Agregado';
                }
                else { 
                    txt = 'Eliminado';
                }

                $("#mensaje_" + pos).html("<span class='btn btn-success'>" + txt + "</span>");
                $("#mensaje_" + pos).fadeOut(5000);
            },
            //capturar el error y mostrarlo en la capa mensaje
            error: function(jqXHR, textStatus, errorThrown){
                $("#mensaje_" + pos).show();
                $("#mensaje_" + pos).html("<span class='btn btn-danger'>Error al procesar:" + textStatus + ","+ errorThrown + "</span>");
            }
        });
    }

</script>

