<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
    Aplicar el CRUD grocery => para hacerlo es necesario modificar una variable del config.php del codigniter, esa variable
    es csrf regenerate
*/

class Clientes extends CI_Controller 
{
    function __construct()
    {
        //Hereda las caracteristicas del constructor
        parent:: __construct();
        //Cargar libreria
        $this->load->library('grocery_CRUD');
        //instanciar la libreria
        $this->crud = new grocery_CRUD();

        if (!$this->session->userdata('id')) 
        {
            redirect('login');
        }
    }

    public function index()
    {
        $data["nombreusuario"] = $this->session->userdata('nombre'); 
        $data["modulo"] = "Clientes";
        $data["descripcion"] = "Listado de clientes en el sistema";

        //Usar el crud grocery para poder cargar el crud de roles.
        //Esta herramienta se configura y genera tres archivos: el render o tabla, los js para ejecutarlo y los css asosciados.
        //Estos tres datos se deben pasar a la vista

        //1 - cargar el tema de la tabla: Flexigrid o datatables.
        $this->crud->set_theme('flexigrid');

        //2- Cargar la tabla
        $this->crud->set_table('clientes');

        //Si queremes relacionar dos tablas y que podemos por medio de un select asociar un dato de una
        //de ellas usamos set_relation (campo de la tabla set table, la tabla asociar, que campo mostrar de la tabla asociar)
        $this->crud->set_relation("tipocliente","tiposdeclientes","nombre");

        //Definir que campos se deben cargar en editar o en el ingresar
        $this->crud->fields("tipocliente","nit","nombre","comercial","telefono","direccion","correo","rut","estadosfinancieros");

        //Definir que campos son requeridos
        $this->crud->required_fields("tipocliente","nit","nombre","telefono","direccion","correo");

        //3 - Se le definde un titulo a la tabla
        $this->crud->set_subject("Clientes");

        $this->crud->display_as("tipocliente","Seleccione el tipo de cliente");
        $this->crud->display_as("nit","Digite su cc o nit");
        $this->crud->display_as("nombre","Digite su razón social");
        $this->crud->display_as("telefono","Digite su telefono");
        $this->crud->display_as("direccion","Dirección");
        $this->crud->display_as("correo","Email");
        $this->crud->display_as("rut","Cargar el rut");
        $this->crud->display_as("estadosfinancieros","Cargar los estados financieros");

        $this->crud->columns("tipocliente","nit","nombre","telefono","direccion", "correo");

        //Se pueden subir archivos a determinados campos usando set_field_upload("campo","ruta donde se cargara el archvio")
        $this->crud->set_field_upload("rut","assets/uploads/clientes/");
        $this->crud->set_field_upload("estadosfinancieros","assets/uploads/clientes/");
        $data["fotousuario"]   = $this->session->userdata('foto'); 
        $data["facebook"]      = $this->session->userdata('facebook'); 
        $data["twitter"]       = $this->session->userdata('twitter'); 
        $data["linkedin"]      = $this->session->userdata('linkedin'); 

        //4 - Aplicar el render, que es ejecutar estas variables y esperar los tres componentes para cargar en la vista.
        $tabla = $this->crud->render();

        //Los tres componentes se llaman output, js_files y css_files
        $data["contenido"] = $tabla->output;
        $data["js_files"]  = $tabla->js_files;
        $data["css_files"] = $tabla->css_files;

        $this->load->view('crud', $data);
    }
}

