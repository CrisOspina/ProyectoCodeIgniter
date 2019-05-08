<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Constrollador salir
class Salir extends CI_Controller 
{
    function __construct()
    {
        //Hereda las caracteristicas del constructor
        parent:: __construct();
        // invocar el modelo
        $this->load->model("usuarios_model");
    }

    public function index()
    {
        /*Cuando se cargue el enlace hacia el controlador salir, en esta función se destruyen las variables y se redirecciona hacia login para que forze el usuario y clave de nuevo*/
        $this->session->sess_destroy();
        redirect('login');
    }
}
