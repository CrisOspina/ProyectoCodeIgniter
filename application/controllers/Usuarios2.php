<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Para pasar datos a una vista se usan arrays y despues del nombre de la vista se invoca el array separado por una coma
//Los datos se arman en un vector y cada posición titne un nombre y ese nombre es el que se pintara en la vista.

class Usuarios extends CI_Controller 
{
    /*
    * Si en toda la clase se va a usar o realizar operaciones con un modelo se recomienda instanciarlo en el constructor
    */

    function __construct()
    {
        parent:: __construct(); //Hereda las caracteristicas del constructor
        // invocar el modelo
        $this->load->model("usuarios_model");

        if (!$this->session->userdata('id')) 
        {
            redirect('login');
        }
    }   

    public function index()
    {
        $data["nombreusuario"] = $this->session->userdata('nombre'); 

        $listar = $this->usuarios_model->listar();

        $data['listado']=$listar;
        $data['titulo']="Usuarios";

        $this->load->view('usuarios', $data);
    }

	public function listado()
	{
        $data = $this->usuarios_model->listar();
        //print_r($data);
        //exit();
        $vector["listado"]=$data;
        $vector["titulo"] = "Listado de usuarios";


		$this->load->view('usuarios-tabla', $vector);
    }

    public function eliminar($param)
    {
        /*
            Proceso de eliminación
            1. Invocar una función del modelo que permita borrar el registro.
            2. Devolverlo a la principal del controlador.
        */
       $this->usuarios_model->eliminar($param);
       redirect('usuarios');
    }

    public function nuevo()
    {
        $data["nombreusuarioe"]=$this->session->userdata('nombre');
        $data['titulo']="Ingreso de nuevo usuario";
        /*
            Proceso de inserción.
            1. Preguntamos si se pasa el vector _post > 0
            2. Si es mayor a cero, es porque estan enviando datos desde un formulario.
            3. Cargar el modelo que permita ingresar.
            4. Pasaremos una variable llamada mensaje a la vista en el cual le indicamos si el registro fue ingresado o no
         */
        if (count($this->input->post())>0) 
        {
         $resp=$this->usuarios_model->ingresar();
         $data["mensaje"]=$resp;
        }

        $this->load->view('usuarios_forma', $data);
    }


    //Editar
    public function editar($param)
    {
        $data["nombreusuarioe"]=$this->session->userdata('nombre');
        $data['titulo']="Edicion de registro";

        if (count($this->input->post())>0) 
        {
            //Cuando se presione un boton es porque los datos se estan enviando al controlador
            //se realizaran las operaciones de modificación
            $mensaje=$this->usuarios_model->modificar($param);
            $data["mensaje"]=$mensaje;
        }

        //Invocar una función del modelo que nos traiga los datos del parametro pasado en la función
        $registro=$this->usuarios_model->detalle($param);

        $data["registro"]=$registro;
        $data["param"]=$param;
        $this->load->view('usuarios_forma',$data);
    }
}
