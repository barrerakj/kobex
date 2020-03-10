<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento_model extends CI_Model {
    
    public function obtener($id){
        $sql = "SELECT * FROM documents WHERE id = ?";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function nuevo($documento, $descripcion){
        
        $result = true;

        $sql = "INSERT INTO documents (name, users_id, cases_id, done, created_at) VALUES (?,?,?,'no','".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, $documento))
            $result = false;
        else {
            $_SESSION['id_documento'] = $this->db->insert_id();

            $sql = "INSERT INTO versions (users_id, documents_id, description, created_at) VALUES (?,?,?,'".date("Y-m-d H:i:s")."')";
            if (!$this->db->query($sql, array($_SESSION['id'], $_SESSION['id_documento'], $descripcion)))
                $result = false;
            else 
                $result = $this->db->insert_id();
        }

        return $result;
    }

    public function nueva_version($descripcion){
        $result = true;
        
        $sql = "INSERT INTO versions (users_id, documents_id, description, created_at) VALUES (?,?,?,'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, array($_SESSION['id'], $_SESSION['id_documento'], $descripcion)))
            $result = false;
        else 
            $result = $this->db->insert_id();
        
        return $result;
    }

    public function ruta($id_version, $ruta){
        $result = true;

        $sql = "UPDATE versions SET path = ?, updated_at = '".date("Y-m-d H:i:s")."' WHERE id = ?";
        if (!$this->db->query($sql, array($ruta, $id_version)))
            $result = false;
        else
            $result = $this->db->insert_id();

        return $result;
    }

    public function listar($users_id, $clients_id, $estado){
        $sql = "SELECT * FROM documents WHERE users_id = ? AND clients_id = ? AND  done = ?";
        $query = $this->db->query($sql, array($users_id, $clients_id, $estado));
        return $query->result_array();
    }

    public function finalizar($id){
        $result = true;

        $sql = "UPDATE documents SET done = 'yes' WHERE id = ?";
        if (!$this->db->query($sql, array($id)))
            $result = false;
        
        return $result;
    }

    public function reanudar($id){
        $result = true;

        $sql = "UPDATE documents SET done = 'no' WHERE id = ?";
        if (!$this->db->query($sql, array($id)))
            $result = false;
        
        return $result;
    }

    public function versiones(){
        $sql = "SELECT v.* FROM versions as v ORDER BY v.id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function version($id){
        $sql = "SELECT v.*, p.name as name, p.lastname as lastname FROM versions as v, users as u, persons as p WHERE v.documents_id = ? AND v.users_id = u.id AND u.persons_id = p.id ORDER BY v.id DESC";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

    public function cliente($id){
        $sql = "SELECT p.* FROM documents as d, clients as c, persons as p WHERE d.id = ? AND d.clients_id = c.id AND c.persons_id = p.id";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
}