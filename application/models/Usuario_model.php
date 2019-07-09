<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function nuevo($persona, $usuario,$plans_id){
        $result = true;

        $sql = "INSERT INTO persons (name, lastname, address, phone1, created_at) VALUES (?,?,?,?,'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, $persona))
            $result = false;
        
        $person_id = $this->db->insert_id();
        $usuario[0] = $person_id;

        $sql = "INSERT INTO users (persons_id, code, email, password, token, created_at) VALUES (?,?,?,?,?,'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, $usuario))
            $result = false;

        $users_id = $this->db->insert_id();

        $sql = "INSERT INTO users_plans (users_id, plans_id, active, created_at) VALUES (?,?,?,'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, array($users_id, $plans_id, "no")))
            $result = false;
        
        return $result;
    }

    public function actualizar($id, $persona){
        $result = true;

        $sql = "SELECT u.persons_id as id FROM users as u WHERE u.id = ?";
        $query = $this->db->query($sql, array($id));
        $row = $query->row_array();
        $persons_id = $row['id'];

        $sql = "UPDATE persons as p SET p.name = ?, p.lastname = ?, p.address = ?, p.phone1 = ?, p.more = ?, p.updated_at = '".date("Y-m-d H:i:s")."' WHERE p.id = ".$persons_id;
        if (!$this->db->query($sql, $persona))
            $result = false;
        
        return $result;
    }

    public function actualizar_pass($id, $pass){
        $result = true;

        $sql = "UPDATE users SET password = ? WHERE id = ?";
        if (!$this->db->query($sql, array($pass,$id)))
            $result = false;
        
        return $result;
    }

    public function obtener($id){
        $sql = "SELECT u.email as email, p.name as name, p.lastname as lastname, p.address as address, p.phone1 as phone, p.more as more, u.users_id as id_principal FROM users as u, persons as p Where u.persons_id = p.id AND u.id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function plan($id){
        $sql = "SELECT users_id FROM users WHERE id = ?";
        $query = $this->db->query($sql, array($id));

        $result = $query->result_array();
        $usuario_principal = $result[0]["users_id"];

        $sql = "SELECT p.name as name, p.lastname as lastname,  pl.name as plan_name, up.created_at as created, up.expires_at as expires FROM users as u, persons as p, plans as pl, users_plans as up WHERE u.id = ? AND u.persons_id = p.id AND up.users_id = ? AND up.plans_id = pl.id";
        $query = $this->db->query($sql, array($usuario_principal,$usuario_principal));

        return $query->result_array();
    }

    public function obtener_id($codigo){
        $sql = "SELECT id FROM users WHERE code = ?";
        $query = $this->db->query($sql, array($codigo));
        return $query->result_array();
    }
    
    public function listar($id){
        $sql = "SELECT u.id as id, p.name as name, p.lastname as lastname, u.created_at as date, p.phone1 as phone, u.email as email FROM persons as p, users as u, leaders_users as lu WHERE lu.leader_id = ? AND lu.user_id = u.id AND u.id = p.id";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function asociar($leader_id,$id){
        $result = true;
        $sql = "INSERT INTO leaders_users (leader_id, user_id, created_at) VALUES (?,?,'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, array($leader_id,$id)))
            $result = false;
        
        return $result;
    }

    public function desasociar($id){
        $result = true;

        $sql = "UPDATE users SET users_id = null, updated_at = '".date("Y-m-d H:i:s")."' WHERE id = ?";
        if (!$this->db->query($sql, array($id)))
            $result = false;
        
        return $result;
    }

    public function cambiar_rol($id, $rol_id){
        $result = true;

        $sql = "UPDATE users SET roles_id = ?, updated_at = '".date("Y-m-d H:i:s")."' WHERE id = ?";
        if (!$this->db->query($sql, array($rol_id, $id)))
            $result = false;
        
        return $result;
    }
}
