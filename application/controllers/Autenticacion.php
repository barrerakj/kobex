<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Autenticacion_model');
        $this->load->model('Bitacora_model');
        $this->load->model('Usuario_model');
    }

    //---------------------------------------------
    //Manipulacion de Datos
    //---------------------------------------------

    public function verificar(){
        $email = $this->input->post('email');
        $contraseña = $this->input->post('password');

        //Obtener ID de usuario para hacer operaciones
        $id_usuario = $this->Autenticacion_model->obtener_id($email);

        //Obtener ID de usuario principal para obtener datos correctos
        $id_principal = $this->Autenticacion_model->obtener_id_principal($id_usuario);

        $contraseña_guardada = $this->Autenticacion_model->obtener_contraseña($id_usuario);
        
        //desencriptar ambas contraseñas

        if($contraseña_guardada == $contraseña){
            $token = $this->Autenticacion_model->obtener_token($id_usuario);

            //Crear la sesion del usuario
            $_SESSION['id'] = $id_usuario;
            $_SESSION['id_principal'] = $id_principal;
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $token;

            //Verificar que exista la carpeta para crearla o no
            if (!file_exists("documents/".$id_principal) && !is_dir("documents/".$id_principal)) {
                mkdir("documents/".$id_principal);
                copy("application/index.html","documents/".$id_principal."/index.html");     
            }

            //Registrar la sesion del usuario en BD
            $this->Bitacora_model->registrar($id_usuario, "Autenticación");

            $json = array($email,$token);
        } else {
            $json = array($email, false);
        }

        //Emitir json con la informacion
        echo json_encode($json);
    }

    //---------------------------------------------
    //Vistas
    //---------------------------------------------

    public function formEntrar(){
        $this->load->view('autenticacion/formEntrar');
    }

    public function formCrear(){
        $this->load->view('autenticacion/formCrear');
    }

    public function pagConfirmar(){
        $this->load->view('autenticacion/pagConfirmar');
    }

    public function formRecuperar(){
        $this->load->view('autenticacion/formRecuperar');
    }

    public function pagSalir(){
        session_destroy();
        $this->load->view('autenticacion/pagSalir');
    }

}