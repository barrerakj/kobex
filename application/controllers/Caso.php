<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Caso_model');
        //$this->load->model('Documento_model');
        //$this->load->model('Cliente_model');
    }

    //---------------------------------------------
    //Manipulacion de Datos
    //---------------------------------------------

    public function obtener($id = 0){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            if($id == 0)
                $id = $_SESSION['id_documento'];

            

            $caso = $this->Caso_model->obtener($id);
            $documento = $this->Documento_model->obtener($id);
            $versiones = $this->Documento_model->versiones($id);
            $json = array(true, $cliente, $documento, $versiones);

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    
    public function guardar(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
            
            $nombre = $this->input->post('_nombre');
            $descripcion = $this->input->post('_descripcion');
            $estado = $this->input->post('_estado');
            
            $resultado = $this->Caso_model->nuevo($nombre, $descripcion, $estado);

            if($resultado){
                $json = array(true,$resultado);
            } else {
                $json = array(false);
            }

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function archivar($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
                      
            $resultado = $this->Caso_model->archivar($id);

            if($resultado){
                $json = array(true,$resultado);
            } else {
                $json = array(false);
            }

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function reactivar($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
                      
            $resultado = $this->Caso_model->reactivar($id);

            if($resultado){
                $json = array(true,$resultado);
            } else {
                $json = array(false);
            }

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function eliminar($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
                      
            $resultado = $this->Caso_model->eliminar($id);

            if($resultado){
                $json = array(true,$resultado);
            } else {
                $json = array(false);
            }

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function guardarClientes() {
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
            
            $casoId = $this->input->post('_casoId');
            $clientes = explode(",",$this->input->post('_clientes'));
            
            $resultado = $this->Caso_model->guardar_clientes($casoId, $clientes);

            if($resultado){
                $json = array(true,$resultado);
            } else {
                $json = array(false);
            }

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function guardarUsuarios(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
            
            $casoId = $this->input->post('_casoId');
            $usuariosRol = explode(",",$this->input->post('_usuariosRol'));
            
            $resultado = $this->Caso_model->guardar_usuarios($casoId, $usuariosRol);

            if($resultado){
                $json = array(true,$resultado);
            } else {
                $json = array(false);
            }

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function listarActivos(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
        
            $id_principal = $_SESSION['id'];
            $json = array(true, $this->Caso_model->listar($id_principal, 'active'));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function listarArchivados(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
        
            $id_principal = $_SESSION['id'];
            $json = array(true, $this->Caso_model->listar($id_principal, 'archive'));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    //---------------------------------------------
    //Vistas
    //---------------------------------------------

    public function formNuevo(){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_header["css"] = "chosen/chosen-boostrap.css";
        $data_footer["js"] = "caso/formNuevo.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('caso/formNuevo');
        $this->load->view('general/footer', $data_footer);
    }

    public function pagDetalle($id){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $_SESSION['id_caso'] = $id;

        $data_footer["js"] = "caso/pagDetalle.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('caso/pagDetalle');
        $this->load->view('general/footer', $data_footer);
    }

    public function pagEnProceso(){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "caso/pagEnProceso.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('caso/pagEnProceso');
        $this->load->view('general/footer', $data_footer);
    }

    public function pagArchivado(){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "caso/pagArchivado.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('caso/pagArchivado');
        $this->load->view('general/footer', $data_footer);
    }
}