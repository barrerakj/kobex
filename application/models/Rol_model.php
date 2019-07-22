<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rol_model extends CI_Model {
    
    public function listado(){
        $sql = "SELECT * from roles";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}