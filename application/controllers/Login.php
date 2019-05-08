<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
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
        $this->load->view('login');
    }

    //Este controlador es el que permite validar con el modelo si el usuario existe.
    function acceso()
    {
        //1- Forma
        //Validar campos vacios.
        /*if ($_POST['correo'] <> "" && $_POST['clave'] <> "") 
        {
            //Invoque el modelo       # code...
        }
        else
        {
            redirect('login');
        }*/

        /*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

        // 2 Forma
        //El proceso de validación lo hará por completo el modelo, lo único que va ser el controlador es invocar el modelo.
        //Si el modelo retorna valores, que permita cargar las variables de sesion.
        //Si no trae datos lo mande con un redirect a login
        
        $data = $this->usuarios_model->validar_acceso();

        //Pintar arrays
        //print_r($data);
        //exit();

        if (sizeof($data)>0) 
        {
            //Cargar datos
            //Las sesiones en el codigniter no se cargan normalmente, se usa es para pasar los datos a un vector asociativo y luego ejecutar la función set_userdata y para que esto funcione debe estar la libreria session activa
            $data_session = array(
                                 "id"       => $data[0]["id"],
                                 "nombre"   => $data[0]["nombre"],
                                 "telefono" => $data[0]["telefono"],
                                 "foto"     => $data[0]["foto"],
                                 "facebook" => $data[0]["facebook"],
                                 "twitter"  => $data[0]["twitter"],
                                 "linkedin" => $data[0]["linkedin"]
            );
            $this->session->set_userdata($data_session);
            redirect('principal');
        }
        else
        {
            redirect('login');
        }
    }
}
