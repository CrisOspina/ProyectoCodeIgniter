<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
    Aplicar el CRUD grocery => para hacerlo es necesario modificar una variable del config.php del codigniter, esa variable
    es csrf regenerate
*/

class Productos extends CI_Controller 
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
        $data["modulo"] = "Categoria de producto";
        $data["descripcion"] = "Listado de categorias donde se ubican los productos";

        //Usar el crud grocery para poder cargar el crud de roles.
        //Esta herramienta se configura y genera tres archivos: el render o tabla, los js para ejecutarlo y los css asosciados.
        //Estos tres datos se deben pasar a la vista

        //1 - cargar el tema de la tabla: Flexigrid o datatables.
        $this->crud->set_theme('flexigrid');

        //2- Cargar la tabla
        $this->crud->set_table('productos');
        $this->crud->set_relation("categoria", "categoriasproductos", "nombre"); 

        //3 - Se le definde un titulo a la tabla
        $this->crud->set_subject("Listado de productos");

        //Definir que campos se deben cargar en editar o en el ingresar
        $this->crud->fields("categoria","ref","nombre", "foto1", "foto2", "descripcion", "precio", "iva", "cant");

        //Otras configuracionesd
        //Definir que campos son requeridos
        $this->crud->required_fields("ref","nombre","foto1", "precio","iva", "cant");

        //Cambiar el nombre del campo en la pantalla
        $this->crud->display_as("categoria","Selecciona la categoria");
        $this->crud->display_as("ref","Digita la referencia");
        $this->crud->display_as("nombre","Digita nombre");
        $this->crud->display_as("descripcion","Resumen - detalle del producto");
        $this->crud->display_as("precio","Precio");
        $this->crud->display_as("iva","% de iva");
        $this->crud->display_as("cant","Cantidad disponible");
        $this->crud->display_as("foto1","Imagen 1");
        $this->crud->display_as("foto2","Imagen 2");
        $this->crud->set_field_upload("foto1","assets/uploads/productos/");
        $this->crud->set_field_upload("foto2","assets/uploads/productos/");
        $this->crud->columns("foto1","categoria", "ref", "nombre", "precio", "iva", "cant");

        $this->crud->change_field_type("precio", "integer");
        $this->crud->change_field_type("iva", "integer");
        $this->crud->change_field_type("cant", "integer");

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

