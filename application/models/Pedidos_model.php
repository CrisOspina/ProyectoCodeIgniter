<?php

/* 
    Modelo de pedidos
*/

class Pedidos_model extends CI_model
{
	function __construct()
	{
		//Invocar el helper security
		$this->load->helper('security');
	}

    function agregar()
    {
       //recuperar datos y aplicarle la seguridad que esta en el helper
       $ref      = $this->input->post('ref');
       $token    = $this->input->post('token');
       $cantidad = $this->input->post('cant');
       $precio   = $this->input->post('precio');
       $impuesto = $this->input->post('impuesto');
       $subtotal = $this->input->post('subtotal');
       $tipo     = $this->input->post('tipo');

       //Seguridad
       $ref      = $this->security->xss_clean($ref);
       $token    = $this->security->xss_clean($token);
       $cantidad = $this->security->xss_clean($cantidad);
       $precio   = $this->security->xss_clean($precio);
       $impuesto = $this->security->xss_clean($impuesto);
       $subtotal = $this->security->xss_clean($subtotal);
       $tipo     = $this->security->xss_clean($tipo);

       //Validar existencia del registro.
       $vector = array("ref" => $ref, "token" => $token);
       $query  = $this->db->get_where("pedidos_detalle", $vector);

       $res = $query->result_array();

       if(count($res) > 0 ){
            //actualizar
            //Sirve también para ellminar el registro, dependiendo si paso 1 0 2
            //El update se pasa en un vector los datos a actualizar, se pide las condiciones y luego se ejecuta el update, el mismo principio es para el delete.
            $data = array("precio"   =>$precio,
                          "impuesto" =>$impuesto,
                          "subtotal" =>$subtotal,
                          "cantidad" => $cantidad
            );

            $this->db->where("token", $token);
            $this->db->where("ref", $ref);

            if ($tipo == 1) {
                //Actualice
                $this->db->update("pedidos_detalle",$data);
            }
            else if ($tipo == 2){
                $this->db->delete("pedidos_detalle");
            }
        }
       else {
           //insertar
           $data = array("precio"   => $precio,
                         "impuesto" => $impuesto,
                         "subtotal" => $subtotal,
                         "cantidad" => $cantidad,
                         "ref"      => $ref,
                         "token"    => $token
            );

       if ($tipo == 1){
           $this->db->insert("pedidos_detalle", $data);
       }
    }

    //Traer el total del carrito
    $totalpedido = $this->carrito();
    return $totalpedido;

    }

    //Función que me calcula cual es el valor total de lo que llevo en el pdido detalle basado en el token
    function carrito(){
        $token = $this->input->post('token');
        $token = $this->security->xss_clean($token);

        $vector = array("token" => $token);
        $query  = $this->db->get_where("pedidos_detalle", $vector);
        $total = 0;
        $res = $query->result_array();

        foreach ($res as $fila) {
            $total = $total + $fila["subtotal"];
        }

        return $total;
    }
}

?>
