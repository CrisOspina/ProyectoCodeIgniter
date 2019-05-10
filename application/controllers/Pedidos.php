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
<<<<<<< HEAD
=======
        $this->load->model("pedidos_model");
>>>>>>> tmp
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

        //Cargar a la vista.
        $this->load->view('nuevopedido', $data);
<<<<<<< HEAD

=======
    }

    //Funcion agregar que nos servira para agregar o quitar productos del pedido
    function agregar(){
        //cargar el model de pedidos con una función que nos permita agregar o eliminar de la tabla de pedidos_detalle
        $respuesta = $this->pedidos_model->agregar();

        //Devuelva lo que retorne el modelo
        echo $respuesta;
>>>>>>> tmp
    }
}
