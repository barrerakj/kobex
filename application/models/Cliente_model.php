<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {

    public function obtener($id){
        $sql = "SELECT c.id as idCliente, p.* FROM persons as p, clients as c WHERE c.id = ? AND c.persons_id = p.id";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
    
    public function listar($users_id){
        $sql = "SELECT c.id as id, p.name as name, p.lastname as lastname, p.phone1 as phone, c.created_at as date FROM persons as p, clients as c WHERE c.persons_id = p.id AND c.users_id = ?";
        $query = $this->db->query($sql, array($users_id));
        return $query->result_array();
    }
    
    public function nuevo($users_id, $cliente){
        
        $result = true;

        $sql = "INSERT INTO persons (name, lastname, address, phone1, phone2, more, created_at) VALUES (?,?,?,?,?,?,'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, $cliente))
            $result = false;
        
        $person_id = $this->db->insert_id();

        $sql = "INSERT INTO clients (persons_id, users_id, created_at) VALUES (".$person_id.",".$users_id.",'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql))
            $result = false;
        
        return $result;
    }

    public function actualizar($id, $cliente){
        
        $result = true;

        $sql = "SELECT c.persons_id as id FROM clients as c WHERE c.id = ?";
        $query = $this->db->query($sql, array($id));
        $row = $query->row_array();

        $persons_id = $row['id'];

        $sql = "UPDATE persons SET name = ?, lastname = ?, address = ?, phone1 = ?, phone2 = ?, more = ?, updated_at = '".date("Y-m-d H:i:s")."' WHERE id = ".$persons_id;
        if (!$this->db->query($sql, $cliente))
            $result = false;
        
        return $result;
    }

    public function eliminar($id){
        
        $result = true;

        $sql = "SELECT c.persons_id as id FROM clients as c WHERE c.id = ?";
        $query = $this->db->query($sql, array($id));
        $row = $query->row_array();

        $persons_id = $row['id'];
        
        $sql = "DELETE from clients WHERE id = ".$id;
        if (!$this->db->query($sql))
            $result = false;
        
        $sql = "DELETE from persons WHERE id = ".$persons_id;
        if (!$this->db->query($sql))
            $result = false;
        
        return $result;
    }

}