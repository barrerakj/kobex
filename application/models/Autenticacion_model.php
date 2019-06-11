<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion_model extends CI_Model {
    
    public function obtener_id($email){        
        $sql = "SELECT u.id as id FROM users as u WHERE u.email = ?";
        $query = $this->db->query($sql, array($email));
        $row = $query->row_array();

        if (isset($row)) {
            return $row['id'];
        } else {
            return false;
        }
    }

    public function obtener_id_leader($id){
        $sql = "SELECT l.leader_id as id FROM leaders_users as l WHERE l.user_id = ?";
        $query = $this->db->query($sql, array($id));
        $row = $query->row_array();

        if (isset($row)) {
            return $row['id'];
        } else {
            return false;
        }
    }
    
    public function obtener_contraseña($id){        
        $sql = "SELECT u.password as pass FROM users as u WHERE u.id = ?";
        $query = $this->db->query($sql, array($id));
        $row = $query->row_array();

        if (isset($row)) {
            return $row['pass'];
        } else {
            return false;
        }
    }

    public function obtener_token($id){
        $sql = "SELECT u.token as token FROM users as u WHERE u.id = ?";
        $query = $this->db->query($sql, array($id));
        $row = $query->row_array();

        if (isset($row)) {
            return $row['token'];
        } else {
            return false;
        }
    }
}