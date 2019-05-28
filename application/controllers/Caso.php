<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caso extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('Documento_model');
        //$this->load->model('Cliente_model');
    }

    //---------------------------------------------
    //Vistas
    //---------------------------------------------

    public function formNuevo(){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "caso/formNuevo.js";

        $this->load->view('general/header', $data_header);
        $this->load->view('caso/formNuevo');
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