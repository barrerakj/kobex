<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cliente_model');
    }

    //---------------------------------------------
    //Manipulacion de Datos
    //---------------------------------------------

    public function listar(){
        
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
        
            $id_principal = $_SESSION['id_principal'];
            $json = array(true, $this->Cliente_model->listar($id_principal));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function guardar($id = 0){
        
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
            
            $nombre = $this->input->post('_nombre');
            $apellido = $this->input->post('_apellido');
            $telefono1 = $this->input->post('_telefono1');
            $telefono2 = $this->input->post('_telefono2');
            $direccion = $this->input->post('_direccion');
            $otros = $this->input->post('_otros');

            $cliente = array($nombre, $apellido, $direccion, $telefono1, $telefono2, $otros);

            $id_principal = $_SESSION['id_principal'];

            if($id == 0){
                if($this->Cliente_model->nuevo($id_principal, $cliente)){
                    $json = array(true);
                } else {
                    $json = array(false);
                }
            } else {
                if($this->Cliente_model->actualizar($id, $cliente)){
                    $json = array(true);
                } else {
                    $json = array(false);
                }
            }

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function eliminar($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            $json = array(true,$this->Cliente_model->eliminar($id));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    //---------------------------------------------
    //Vistas
    //---------------------------------------------
    
    public function formInfo($id = 0){
        
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data = [];

        if($id != 0)
            $data["cliente"] = $this->Cliente_model->obtener($id);

        $data_footer["js"] = "cliente/formInfo.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('cliente/formInfo', $data);
        $this->load->view('general/footer', $data_footer);
    }

    public function pagListado(){
        
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "cliente/pagListado.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('cliente/pagListado');
        $this->load->view('general/footer', $data_footer);
    }
}