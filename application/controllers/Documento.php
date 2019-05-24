<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Documento_model');
        $this->load->model('Cliente_model');
    }


    //---------------------------------------------
    //Manipulacion de Datos
    //---------------------------------------------
    public function obtener($id = 0){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            if($id == 0)
                $id = $_SESSION['id_documento'];

            $cliente = $this->Documento_model->cliente($id);
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
            $idPlantilla = $this->input->post('_idPlantilla');
            $idCliente = $this->input->post('_idCliente');
            $descripcion = $this->input->post('_descripcion');

            $id_principal = $_SESSION['id_principal'];
            
            $documento = array($nombre, $idCliente, $idPlantilla, $id_principal);            

            $resultado = $this->Documento_model->nuevo($documento, $descripcion);

            if($resultado){
                $_SESSION['id_version'] = $resultado;
                $json = array(true);
            } else {
                $json = array(false);
            }

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function actualizar_version(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
            $descripcion = $this->input->post('_descripcion');
            $resultado = $this->Documento_model->nueva_version($descripcion);
            if($resultado){
                $_SESSION['id_version'] = $resultado;
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
        if(isset($_SESSION['id_version'])){
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
                    $nombre_archivo = "version".$_SESSION['id_version']."-".$_FILES['files']['name'][0];
                    
                    $ruta_absoluta= $ruta_general . $nombre_archivo;                
    
                    if(move_uploaded_file($ruta_temporal, $ruta_absoluta)){
                        $this->Documento_model->ruta($_SESSION['id_version'], $ruta_absoluta);
                        unset($_SESSION['id_version']);
                        $json = array(true, $_SESSION['id_documento']);
                    } else {
                        $json = array(false, "Hemos experimentado un problema interno. Intente mas tarde.");
                    }
                } else {
                    $json = array(false, "La extension del archivo es incorrecta. Asegurese que su archivo sea de tipo .docx o .doc para poder guardarlo.");
                }
            } else {
                $json = array(false, "No existe un archivo para guardar. Porfavor agregue uno.");
            }
        } else {
            $json = array(false, "Error. Pongase en contacto con el administrador del sistema cuanto antes.");
        }
        
        echo json_encode($json);
    }

    public function listar($tipo){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){
            
            $result = [];

            $id_principal = $_SESSION['id_principal'];
            $clientes = $this->Cliente_model->listar($id_principal);
            //1. Listar todos los clientes para el id principal dado

            //Listar documentos que estan en proceso
            if($tipo == 1){
                for ($i=0; $i < count($clientes); $i++) { 
                    $id_cliente = $clientes[$i]['id'];
                    $documentos = $this->Documento_model->listar($id_principal, $id_cliente, "no");
                    if(count($documentos) > 0) 
                        array_push($result, array($clientes[$i], $documentos));
                }
            }

            //Listar documentos que estan archivados
            if($tipo == 2){
                for ($i=0; $i < count($clientes); $i++) { 
                    $id_cliente = $clientes[$i]['id'];
                    $documentos = $this->Documento_model->listar($id_principal, $id_cliente, "yes");
                    if(count($documentos) > 0) 
                        array_push($result, array($clientes[$i], $documentos));
                }
            }
            
            $json = array(true, $result);

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function versiones(){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            $versiones = $this->Documento_model->versiones();
            $json = array(true, $versiones);

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function ultVersion($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            $versiones = $this->Documento_model->version($id);
            $ultVersion = $versiones[0];
            $json = array(true, $ultVersion);

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function finalizar($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            $json = array(true,$this->Documento_model->finalizar($id));

        } else {
            $json = array(false,base_url()."aut/entrar");
        }

        echo json_encode($json);
    }

    public function reanudar($id){
        $token = $this->input->post('_token');
        if(isset($_SESSION['token']) && $token == $_SESSION['token']){

            $json = array(true,$this->Documento_model->reanudar($id));

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

        $data_footer["js"] = "documento/formNuevo.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('documento/formNuevo');
        $this->load->view('general/footer', $data_footer);
    }

    public function formActualizar($id){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }
        
        $_SESSION['id_documento'] = $id;

        $data_footer["js"] = "documento/formActualizar.js";
        
        $this->load->view('general/header', $data_header);
        $this->load->view('documento/formActualizar');
        $this->load->view('general/footer', $data_footer);
    }

    public function pagDetalle($id){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
            $data_header["css"] = "documento/pagDetalle.css";
        }
        
        $_SESSION['id_documento'] = $id;

        $data_footer["js"] = "documento/pagDetalle.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('documento/pagDetalle');
        $this->load->view('general/footer', $data_footer);
    }

    public function pagEnProceso(){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "documento/pagEnProceso.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('documento/pagEnProceso');
        $this->load->view('general/footer', $data_footer);
    }

    public function pagArchivado(){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "documento/pagArchivado.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('documento/pagArchivado');
        $this->load->view('general/footer', $data_footer);
    }
}