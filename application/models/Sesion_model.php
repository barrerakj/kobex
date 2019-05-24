<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion_model extends CI_Model {
    
    public function registrar($user_id){
        $sql = "INSERT INTO sessions (users_id, created_at) VALUES (".$user_id.",'".date("Y-m-d H:i:s")."')";
        if ($this->db->query($sql))
            return true;
        else
            return false;
    }

    public function listado($id){
        $sql = 'SELECT u.id as id, p.name as name, p.lastname as lastname, s.created_at as access, p.phone1 as phone, u.email as email, u.created_at as date 
                FROM persons as p, users as u, sessions as s
                WHERE (u.id = ? OR u.users_id = ?) AND u.id = s.users_id AND p.id = u.persons_id';
        $query = $this->db->query($sql, array($id, $id));
        return $query->result_array();
    }
}