<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
    Aplicar el CRUD grocery => para hacerlo es necesario modificar una variable del config.php del codigniter, esa variable
    es csrf regenerate
*/

class Usuarios extends CI_Controller 
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
        $data["modulo"] = "Usuarios";
        $data["descripcion"] = "Listado de usuarios en el sistema";

        //Usar el crud grocery para poder cargar el crud de roles.
        //Esta herramienta se configura y genera tres archivos: el render o tabla, los js para ejecutarlo y los css asosciados.
        //Estos tres datos se deben pasar a la vista

        //1 - cargar el tema de la tabla: Flexigrid o datatables.
        $this->crud->set_theme('flexigrid');

        //2- Cargar la tabla
        $this->crud->set_table('usuarios');

        //Si queremes relacionar dos tablas y que podemos por medio de un select asociar un dato de una
        //de ellas usamos set_relation (campo de la tabla set table, la tabla asociar, que campo mostrar de la tabla asociar)
        $this->crud->set_relation("perfil","roles","nombre");

        //Definir que campos se deben cargar en editar o en el ingresar
        $this->crud->fields("perfil","nombre","clave","correo","telefono","foto", "facebook", "twitter", "linkedin");

        //Definir que campos son requeridos
        $this->crud->required_fields("perfil","nombre","clave","correo","telefono");

        //3 - Se le definde un titulo a la tabla
        $this->crud->set_subject("Usuarios");

        $this->crud->display_as("perfil","Rol asociado");
        $this->crud->display_as("nombre","Nombre");
        $this->crud->display_as("telefono","Telefono");
        $this->crud->display_as("clave","Clave de acceso");
        $this->crud->display_as("correo","Email de acceso");
        $this->crud->display_as("fechaingreso","Registro");
        $this->crud->display_as("fechamodificacion","Ultimo cambio");

        $this->crud->columns("foto","perfil","nombre","correo","telefono", "fechaingreso","fechamodificacion");
        $this->crud->set_field_upload("foto","assets/uploads/usuarios/");
        $data["fotousuario"]   = $this->session->userdata('foto'); 
        $data["facebook"]      = $this->session->userdata('facebook'); 
        $data["twitter"]       = $this->session->userdata('twitter'); 
        $data["linkedin"]      = $this->session->userdata('linkedin'); 

        //4 - Aplicar el render, que es ejecutar estas variables y esperar los tres componentes para cargar en la vista.

        //Se pueden realizar operaciones o funciones antes de guardar en la tabla cargada
        //para eso usamos callbacks, estos piden llamar una función y ellos internamente pasan el vector con los datos
        //del formulario
        $this->crud->callback_before_insert(array($this,"encriptar"));

        //Se puede cambiar los tipos de cambios tipo text usando change_field_type
        $this->crud->change_field_type("clave","password");

        //Se puede dependiendo de la acción que se ejecute realizar algún proceso adicional
        if($this->crud->getState()=="edit") 
        {
            $this->crud->field_type("clave", "hidden");
        }

        $tabla = $this->crud->render();

        //Los tres componentes se llaman output, js_files y css_files
        $data["contenido"] = $tabla->output;
        $data["js_files"]  = $tabla->js_files;
        $data["css_files"] = $tabla->css_files;

        $this->load->view('crud', $data);
    }
        //
        function encriptar($post_array)
        {
            $post_array["clave"] = md5($post_array["clave"]);
            return $post_array;
        }
}

