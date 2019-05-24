<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function pagInicio(){
        
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }

        $data_footer["js"] = "inicio/pagInicio.js";
        
        $this->load->view('general/header', $data_header);
        $this->load->view('inicio/pagInicio');
        $this->load->view('general/footer', $data_footer);
    }

    public function pagAyuda(){
        if(isset($_SESSION['email'])){
            $data_header['email'] = $_SESSION['email'];
        }
        
        $this->load->view('general/header', $data_header);
        $this->load->view('inicio/pagAyuda');
        $this->load->view('general/footer');
    }
}