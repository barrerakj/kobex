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
        $sql = 'SELECT u.id as id, p.name as name, l.action as action, p.lastname as lastname, l.created_at as access, p.phone1 as phone, u.email as email
                FROM persons as p, users as u, logs as l
                WHERE l.users_id IN (
	                SELECT user_id 
                    FROM leaders_users
                    WHERE leader_id = ?
                ) AND l.users_id = u.id 
                AND u.persons_id = p.id
                ORDER BY l.created_at DESC';
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
}