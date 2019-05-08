<?php

//Modelo de la tabla usuarios:
/* Los modelos se heredan de la clase principal CI_model.
 * Aprovechar las caracteristicas dpara ahorrar codigo
 */

class Usuarios_model extends CI_model
{
	function __construct()
	{
		//Invocar el helper security
		$this->load->helper('security');
	}

    function listar()
    {
        //Traer el listado de usuarios y devolverlo para que lo lea el controlador y este a su vez lo pase a la vista.
        $query = $this->db->get("usuarios");
        return $query->result_array();
    }

    //Esta función espera dos parámetros que vienen de un formulario, como son datos super globales, no es necesario pasarlos como parametros.
    //($_GET, $_POST, $_FILES, $_ENV, $_SERVER, etc)
    //Aprovechando si vamos a invocar la forma como recibe los parametros.
    function validar_acceso()
    {
    	$correo = $this->input->post('correo');
    	$clave  = $this->input->post('clave');

    	//Aplicar politicas de control y limpieza de código malicioso que nos envian en un formulario.
    	$correo = $this->security->xss_clean($correo);
    	$clave  = $this->security->xss_clean($clave);

    	//select * from usuarios where correo='$correo' and clave=md5('$clave')
    	//Podemos hacer un select usando el comando get_where el cual es la tabla y el vector de los parámetros que deseo usar con el and o con el or.
    	//Vector debe ser asociativo y los nombres de las variables deben coincidir con los nombres de los campos.
    	$vector = array("correo" => $correo, "clave" => md5($clave));
    	$query = $this->db->get_where("usuarios",$vector);
    	//Si se desea ejecutar el query para validar en la base de datos se usa last_query
    	//echo $this->db->last_query();
    	return $query->result_array();
    }

    //Elimina registro
    function eliminar($param)
    {
        // Se puede eliminar realizando el delete from tabla pero el codeigniter maneja su propia libreria que se llama this->db->delete la cual se le debe pasar el parámetro que borrar y ejecutar la función.
        $this->db->where("id", $param);
        return $this->db->delete("usuarios");
    }

    //
    function ingresar()
    {
        $correo=$this->input->post('correo');
        $nombre=$this->input->post('nombre');
        $telefono=$this->input->post('telefono');
        $perfil=$this->input->post('perfil');
        $clave=$this->input->post('clave');
        /*
            Como se hizo en el acceso de login se recuperan las variables, se les aplican xss_clean.
            Preguntar por el campo único correo
         */
        $correo = $this->security->xss_clean($correo);
        $nombre = $this->security->xss_clean($nombre);
        $telefono = $this->security->xss_clean($telefono);
        $perfil = $this->security->xss_clean($perfil);
        $clave = $this->security->xss_clean($clave);
        //Para validar si un registro ya existe podemos usar la function get_where de codeigniter la cual si encuentra registro devuelve el array o en caso contrario devuelve en array pero 0
        $query=$this->db->get_where("usuarios", array('correo' => $correo));
        $resultado = $query->result_array();

        //Validar
        if (count($resultado)>0)
        {
            $resp="Este registro ya se encuentra. Revise los campos";
        }
        else
        {
            //El siguiente proceso aplica tanto para modificar o insertar. Code igniter nos recomienda pasar los datos en un array y ejecutar insert o update.
            $vector=Array(
                "correo"   => $correo,
                "clave"    => md5($clave),
                "nombre"   => $nombre,
                "telefono" => $telefono,
                "perfil"   => $perfil
            );

            $this->db->insert("usuarios", $vector);
            $resp = "Registro insertado con exito";
        }
        return $resp;
    }

    function detalle($param)
    {
        $query=$this->db->get_where("usuarios", array('id' => $param));
        return $query->result_array();
    }

    function modificar($param)
    {
        $correo=$this->input->post('correo');
        $nombre=$this->input->post('nombre');
        $telefono=$this->input->post('telefono');
        $perfil=$this->input->post('perfil');

        $correo = $this->security->xss_clean($correo);
        $nombre = $this->security->xss_clean($nombre);
        $telefono = $this->security->xss_clean($telefono);
        $perfil = $this->security->xss_clean($perfil);

            $vector=Array(
                "correo"   => $correo,
                "nombre"   => $nombre,
                "telefono" => $telefono,
                "perfil"   => $perfil
            );

        //el proceso de edicion usando codeingiter es pasando el parametro where, el vector y a que tabla ejecutarlo. Se parece a el vector que usa con get_where
        $this->db->where("id", $param);
            if ($this->db->update("usuarios", $vector)) 
            {
                $mensaje = "Modificación realizada";
            }
            else
            {
                $mensaje = "No se puede realizar el proceso. Intente de nuevo";
            }

        return $mensaje;
    }
}

?>