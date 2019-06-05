<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->model('Bitacora_model');
        $this->load->model('Autenticacion_model');
    }
    //---------------------------------------------
    //Manipulacion de Datos
    //---------------------------------------------

    public function nuevo(){
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $direccion = $this->input->post('direccion');
        $correo = $this->input->post('correo');
        $pass = $this->input->post('pass');
        $codigo = $this->input->post('codigo');

        /*
        1. Verificar que la variable codigo tenga informacion
        2. Indicar a la funcion "nuevo" que si existe o no existe un id principal
        */

        $result = $this->Usuario_model->obtener_id($codigo);
        $id_principal = $result[0]['id'];
        $id_plan = $result[0]['plans_id'];

        $persona = array($nombre, $apellido, $direccion, $telefono);
        $usuario = array($id_principal, "persons_id", "0101", $correo, $pass, "token".$nombre.$apellido, 4);
        
        if($this->Usuario_model->nuevo($persona, $usuario, $id_plan))
            $json = array(true);
        else
            $json = array(false);

        echo json_encode($json);        
    }

    public function actualizar(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
            $nombre = $this->input->post('_nombre');
            $apellido = $this->input->post('_apellido');
            $direccion = $this->input->post('_direccion');
            $telefono = $this->input->post('_telefono');
            $descripcion = $this->input->post('_descripcion');
            $id = $_SESSION['id'];
            $persona = array($nombre,$apellido,$direccion,$telefono,$descripcion);

            $resultado = $this->Usuario_model->actualizar($id, $persona);
            if($resultado){
                $json = array(true);
            } else {
                $json = array(false);
            }
        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function actualizar_pass(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
            $id = $_SESSION["id"];
            $pass = $this->input->post('_pass');
            $pass_nuevo = $this->input->post('_nuevo');
            
            $pass_guardada = $this->Autenticacion_model->obtener_contraseña($id);

            if($pass == $pass_guardada){
                $resultado = $this->Usuario_model->actualizar_pass($id, $pass_nuevo);
                if($resultado){
                    $json = array(true);
                } else {
                    $json = array(false);
                }
            } else {
                $json = array(false);
            }
        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function obtener(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
        
            $id = $_SESSION['id'];
            $usuario =  $this->Usuario_model->obtener($id);
            $id_principal = $usuario[0]['id_principal'];

            if($id != $id_principal)
                $usuario_principal = $this->Usuario_model->obtener($id_principal);
            else
                $usuario_principal = $usuario;

            $plan = $this->Usuario_model->plan($id_principal);

            $json = array(true, $usuario, $usuario_principal, $plan);

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }
    
    public function listar(){
        
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
        
            $id_principal = $_SESSION['id'];
            $json = array(true, $this->Usuario_model->listar($id_principal));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function sesiones(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
        
            $id_principal = $_SESSION['id'];
            $json = array(true, $this->Sesion_model->listado($id_principal));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function desasociar($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            $json = array(true,$this->Usuario_model->desasociar($id));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function rol($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            $rol_id = $this->input->post('_rol_id');
            $json = array(true,$this->Usuario_model->cambiar_rol($id, $rol_id));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    //---------------------------------------------
    //Vistas
    //---------------------------------------------

	public function pagListado(){

        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "usuario/pagListado.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('usuario/pagListado');
        $this->load->view('general/footer', $data_footer);
    }

    public function pagSesiones(){
        
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "usuario/pagSesiones.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('usuario/pagSesiones');
        $this->load->view('general/footer', $data_footer);
    }

    public function formCuenta(){
        
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "usuario/formCuenta.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('usuario/formCuenta');
        $this->load->view('general/footer', $data_footer);
    }
}