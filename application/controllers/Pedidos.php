<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Solo se puede acceder a el si las variables de sesion se encuentran activas, como todas las funciones deben preguntar por ellas se validan en el constructor por que es lo primero que se evalua.

class Pedidos extends CI_Controller 
{
    function __construct()
    {
        //Hereda las caracteristicas del constructor
        parent:: __construct();
        //Invocar los modelos que se necesiten para el todo el controlador
        $this->load->model("productos_model");
        $this->load->model("pedidos_model");
        $this->load->model("clientes_model");
        if (!$this->session->userdata('id')) 
        {
            redirect('login');
        }
    }

    public function index()
    {
        $data["nombreusuario"] = $this->session->userdata('nombre'); 
        $data["fotousuario"]   = $this->session->userdata('foto'); 
        $data["facebook"]      = $this->session->userdata('facebook'); 
        $data["twitter"]       = $this->session->userdata('twitter'); 
        $data["linkedin"]      = $this->session->userdata('linkedin'); 
        $data["modulo"]        = "Pedidos";
        $data["descripcion"]   = "Listado de pedidos";

        $data["lista"] = $this->pedidos_model->listar();

        $this->load->view('pedidos', $data);
    }


    //Nuevos productos
    public function nuevo()
    {
        $data["nombreusuario"] = $this->session->userdata('nombre'); 
        $data["fotousuario"]   = $this->session->userdata('foto'); 
        $data["facebook"]      = $this->session->userdata('facebook'); 
        $data["twitter"]       = $this->session->userdata('twitter'); 
        $data["linkedin"]      = $this->session->userdata('linkedin'); 
        $data["modulo"]        = "Pedidos";
        $data["descripcion"]   = "Generar nuevo pedidos";

        //Se van a pasar los datos de los productos y el token que se va a usar para el pedido.
        $data["listaproductos"] = $this->productos_model->listar();

        //Generar token
        //Se va usar un session_id y combinado con un valor aprovechando la version 7 del php usaremos una función que nos genera un valor aleatorio.
        $token = base64_encode(random_bytes(32).session_id());
        /*
        verifica la cantidad de caracteres que contiene el token
        echo $token. "<hr>".strlen($token);
        exit();*/

        //pasar variable
        $data["token"] = $token;

        //Enviar el listado de los clientes que se van a cargar en el select cliente
        $data["listadoclientes"] = $this->clientes_model->listar();

        //Cargar a la vista.
        $this->load->view('nuevopedido', $data);
    }

    //Funcion agregar que nos servira para agregar o quitar productos del pedido
    function agregar(){
        //cargar el model de pedidos con una función que nos permita agregar o eliminar de la tabla de pedidos_detalle
        $respuesta = $this->pedidos_model->agregar();
        
        //Devuelva lo que retorne el modelo
        //echo $respuesta;

        echo "El pedido va en:" .number_format($respuesta, 0);
    }

    //
    function cargarcliente(){
        //del modelo extraer la funcion que trae el detalle del cliente o del registro y devolverlo como un JSON
        $data = $this->clientes_model->detallecliente();
        echo json_encode($data);
    }

    //crear la función finalizar
    function finalizar() {

        //La caracteristica de este sistema de pedidos es que todo gira alrededor del token
        //agregar el token al vector de POST
        $_POST['token'] = $_POST['token_1'];

        //invocar el modelo y esperar la respuesta de este
        $data = $this->pedidos_model->finalizar();

        echo $data;
    }

    //funcion eliminar
    function eliminar($id){
        $this->pedidos_model->eliminar($id);
        redirect('pedidos');
    }

    //proceso de edición
    //1 - cargar los datos del pedido basados en el id que pasemos
    function editar($id) {
        $data["nombreusuario"] = $this->session->userdata('nombre'); 
        $data["fotousuario"]   = $this->session->userdata('foto'); 
        $data["facebook"]      = $this->session->userdata('facebook'); 
        $data["twitter"]       = $this->session->userdata('twitter'); 
        $data["linkedin"]      = $this->session->userdata('linkedin'); 
        $data["modulo"]        = "Pedidos";
        $data["descripcion"]   = "Editar pedido numero" .$id;

        $data["listaproductos"]  = $this->productos_model->listar();
        $data["listadoclientes"] = $this->clientes_model->listar();

        //invocar el encabezado del pedido y guardarlo en el vector data
        $data["encabezado"] = $this->pedidos_model->detalle($id);

        //invocar el detalle del pedido, usando el vector que se almacena en el encabezado
        //1 - método o forma
        // $data["detallepedido"] = $this->pedidos_model->pedido_detalle($data["encabezado"]);

        //recorrer el encabezado y sacar el token y pasarlo en la funcion
        foreach ($data["encabezado"] as $fila) {
            $token = $fila["token"];
        }

        $data["detallepedido"] = $this->pedidos_model->pedido_detalle($token);
        $data["token"] = $token;

        //Cargar a la vista.
        $this->load->view('nuevopedido', $data);
    }
}



