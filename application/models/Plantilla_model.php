<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plantilla_model extends CI_Model {
    
    public function listar($users_id){
        $sql = "SELECT * FROM templates WHERE users_id = ?";
        $query = $this->db->query($sql, array($users_id));
        return $query->result_array();
    }
    
    public function nueva($id_usuario, $plantilla){
        
        $result = true;

        $sql = "INSERT INTO templates (users_id, name, description, created_at) VALUES (".$id_usuario.",?,?,'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, $plantilla))
            $result = false;
        else
            $result = $this->db->insert_id();

        return $result;
    }

    public function eliminar($id){

        $result = true;

        //codigo para borrar el archivo en si

        $sql = "SELECT t.path as path FROM templates as t WHERE t.id = ?";
        $query = $this->db->query($sql, array($id));
        $row = $query->row_array();

        $template_path = $row['path'];

        if(!unlink($template_path))
            $result = false;
        
        //codigo para borrar la fila de la base de datos
        
        $sql = "DELETE from templates WHERE id = ?";
        if (!$this->db->query($sql, array($id)))
            $result = false;
        
        return $result;
    }

    public function ruta($id, $ruta){
        
        $result = true;

        $sql = "UPDATE templates SET path = ?, updated_at = '".date("Y-m-d H:i:s")."' WHERE id = ?";
        if (!$this->db->query($sql, array($ruta, $id)))
            $result = false;
        else
            $result = $this->db->insert_id();

        return $result;
    }
}