<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caso_model extends CI_Model {

    public function listar($users_id){
        //Obtener todos los casos asociados al usuario
        $sql = "SELECT c.id as id, c.name as name, c.description as description, c.created_at as created_date, c.updated_at as updated_date FROM cases as c, users_cases as uc, users as u WHERE  uc.users_id = u.id AND uc.cases_id = c.id AND u.id = ?";
        $query = $this->db->query($sql, array($users_id));
        $UserCases = $query->result_array();

        //Obtener todos los clientes asociados a cada caso
        for ($i=0; $i < count($UserCases); $i++) { 
            $CaseId = $UserCases[$i]['id'];
            $sql = "SELECT p.name, p.lastname FROM cases as c, cases_clients as cc, clients as cl, persons as p WHERE c.id = ? AND c.id = cc.cases_id AND cc.clients_id = cl.id AND cl.persons_id = p.id";
            $query = $this->db->query($sql, array($CaseId));
            $resultClients = $query->result_array();

            //Agregar todos los 
            for ($j=0; $j < count($resultClients); $j++) { 
                //array_push($UserCases[$i], $resultClients[$j]);
                $UserCases[$i]['clients'] = $resultClients[$j];
            }

            $sql = "SELECT p.name, p.lastname FROM cases as c, users_cases as uc, users as u, persons as p WHERE c.id = ? AND c.id = uc.cases_id AND uc.users_id = u.id AND u.persons_id = p.id";
            $query = $this->db->query($sql, array($CaseId));
            $resultUsers = $query->result_array();

            for ($k=0; $k < count($resultUsers); $k++) { 
                //array_push($UserCases[$i], $resultUsers[$k]);
                $UserCases[$i]['users'] = $resultUsers[$k];
            }
            
        }

        return $UserCases;
    }
    
    public function nuevo($nombre, $descripcion){
        
        $result = true;

        $sql = "INSERT INTO cases (name, description, created_at) VALUES (?,?,'".date("Y-m-d H:i:s")."')";
        if (!$this->db->query($sql, array($nombre,$descripcion)))
            $result = false;
        else
            $result = $this->db->insert_id();
        
        return $result;
    }

    public function guardar_clientes($caso_id, $clientes){
        
        $result = true;

        for ($i=0; $i < count($clientes); $i++) { 
            $sql = "INSERT INTO cases_clients (cases_id, clients_id, created_at) VALUES (?,?,'".date("Y-m-d H:i:s")."')";
            if (!$this->db->query($sql, array($caso_id,$clientes[$i])))
                $result = false;
        }
        
        return $result;
    }

    public function guardar_usuarios($caso_id, $usuariosRol){
        
        $result = true;

        for ($i=0; $i < count($usuariosRol); $i=$i+2) { 
            if($usuariosRol[$i+1] != "0"){
                $sql = "INSERT INTO users_cases (users_id, cases_id, roles_id, created_at) VALUES (?,?,?,'".date("Y-m-d H:i:s")."')";
                if (!$this->db->query($sql, array($usuariosRol[$i],$caso_id,$usuariosRol[$i+1])))
                    $result = false;
            }
        }
        
        return $result;
    }

}