<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantilla extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Plantilla_model');
    }

    //---------------------------------------------
    //Manipulacion de Datos
    //---------------------------------------------

    public function guardar(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
            
            $nombre = $this->input->post('_nombre');
            $descripcion = $this->input->post('_descripcion');

            $plantilla = array($nombre, $descripcion);

            $id_principal = $_SESSION['id_principal'];

            $resultado = $this->Plantilla_model->nueva($id_principal, $plantilla);

            if($resultado){
                $_SESSION['id_plantilla'] = $resultado;
                $json = array(true);
            } else {
                $json = array(false);
            }

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function archivo(){
        $json = "";
        if(isset($_SESSION['id_plantilla'])){
            if (isset($_FILES['files'])){
            
                //Verificar extension del documento
                $nombre = $_FILES['files']['name'][0];
                $file_ext = explode('.',$nombre);
                $file_ext = end($file_ext);
                $file_ext = strtolower($file_ext);
    
                if($file_ext == "docx" || $file_ext == "doc"){
                    
                    //Ruta temporal del archivo
                    $ruta_temporal = $_FILES['files']['tmp_name'][0];
    
                    //Ruta general para el usuario principal
                    $ruta_general = 'documents/'.$_SESSION['id_principal'].'/';
    
                    /*
                    Nuevo nombre del archivo
                    plantilla + id de plantilla + "-" + nombre de archivo
                    */
                    $nombre_archivo = "plantilla".$_SESSION['id_plantilla']."-".$_FILES['files']['name'][0];
                    
                    $ruta_absoluta= $ruta_general . $nombre_archivo;                
    
                    if(move_uploaded_file($ruta_temporal, $ruta_absoluta)){
                        $this->Plantilla_model->ruta($_SESSION['id_plantilla'], $ruta_absoluta);
                        unset($_SESSION['id_plantilla']);
                        $json = array(true);
                    } else {
                        $json = array(false, "Hemos experimentado un problema interno. Intente más tarde.");
                    }
                } else {
                    $json = array(false, "La extensión del archivo es incorrecta. Asegúrese que su archivo sea de tipo .docx o .doc para poder guardarlo.");
                }
            } else {
                $json = array(false, "No existe un archivo para guardar. Porfavor agregue uno.");
            }
        } else {
            $json = array(false, "Error. Pongase en contacto con el administrador del sistema cuanto antes.");
        }

        echo json_encode($json);
    }

    public function listar(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
        
            $id_principal = $_SESSION['id_principal'];
            $json = array(true, $this->Plantilla_model->listar($id_principal));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function eliminar($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            $json = array(true,$this->Plantilla_model->eliminar($id));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }
    
    //---------------------------------------------
    //Vistas
    //---------------------------------------------
	public function formNueva(){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "plantilla/formNueva.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('plantilla/formNueva');
        $this->load->view('general/footer', $data_footer);
    }

    public function pagListado(){
        
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
            $data_header["css"] = "plantilla/pagListado.css";
        }

        $data_footer["js"] = "plantilla/pagListado.js";        

        $this->load->view('general/header', $data_header);
        $this->load->view('plantilla/pagListado');
        $this->load->view('general/footer', $data_footer);
    }
}