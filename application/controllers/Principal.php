<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Solo se puede acceder a el si las variables de sesion se encuentran activas, como todas las funciones deben preguntar por ellas se validan en el constructor por que es lo primero que se evalua.

class Principal extends CI_Controller 
{
    function __construct()
    {
        //Hereda las caracteristicas del constructor
        parent:: __construct();
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
        $data["modulo"]        = "Bienvenidos";
        $data["descripcion"]   = "Sistemas de pedidos centralizado";
        $this->load->view('principal', $data);
    }
}
