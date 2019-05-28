<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bitacora_model extends CI_Model {
    
    public function registrar($user_id, $action){
        $sql = "INSERT INTO logs (users_id, action, created_at) VALUES (?,?,'".date("Y-m-d H:i:s")."')";
        if ($this->db->query($sql, array($user_id,$action)))
            return true;
        else
            return false;
    }

    public function listado($id){
        $sql = 'SELECT u.id as id, p.name as name, p.lastname as lastname, l.created_at as access, p.phone1 as phone, u.email as email, u.created_at as date 
                FROM persons as p, users as u, logs as l
                WHERE (u.id = ? OR u.users_id = ?) AND u.id = l.users_id AND p.id = u.persons_id';
        $query = $this->db->query($sql, array($id, $id));
        return $query->result_array();
    }
}