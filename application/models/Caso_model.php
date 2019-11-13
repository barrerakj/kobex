<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caso_model extends CI_Model {

    public function nuevo($nombre, $descripcion){
        
        $result = true;

        $sql = "INSERT INTO cases (name, description, created_at) VALUES (?,?,'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, array($nombre,$descripcion)))
            $result = false;
        else
            $result = $this->db->insert_id();
        
        return $result;
    }

    public function guardar_clientes($casoId, $clientes){
        
        $result = true;

        for ($i=0; $i < count($clientes); $i++) { 
            $sql = "INSERT INTO cases_clients (cases_id, clients_id, created_at) VALUES (?,?,'".date("Y-m-d H:i:s")."')";
            if (!$this->db->query($sql, array($casoId,$clientes[$i])))
                $result = false;
        }
        
        return $result;
    }

    public function guardar_usuarios($casoId, $usuariosRol){
        
        $result = true;

        for ($i=0; $i < count($usuariosRol); $i=$i+2) { 
            if($usuariosRol[$i+1] != "0"){
                $sql = "INSERT INTO users_cases (users_id, cases_id, roles_id, created_at) VALUES (?,?,?,'".date("Y-m-d H:i:s")."')";
                if (!$this->db->query($sql, array($usuariosRol[$i],$casoId,$usuariosRol[$i+1])))
                    $result = false;
            }
        }
        
        return $result;
    }

}