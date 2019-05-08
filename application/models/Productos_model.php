<?php

/* 
    Modelo de productos
*/

class Productos_model extends CI_model
{
	function __construct()
	{
		//Invocar el helper security
		$this->load->helper('security');
	}

    function listar()
    {
        //Traer el listado de pedidos y lo devolverlo para que lo lea el controlador y este a su vez lo pase a la vista.
        $query = $this->db->get("productos");
        return $query->result_array();
    }
}

?>
