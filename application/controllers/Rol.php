<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rol extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Rol_model');
    }

    //---------------------------------------------
    //Manipulacion de Datos
    //---------------------------------------------

    public function listado(){
        
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
        
            $json = array(true, $this->Rol_model->listado());

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }
}