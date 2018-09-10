<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategorias_model extends CI_Model {

    public function getSubByCategoryId($id){
        $this->db->where('categoria_id', $id);
        return $this->db->order_by('descricao', 'asc')->get('subcategorias')->result_array();
    }
    
    public function save($categoria_id, $descricao){
        $this->db->where('categoria_id', $categoria_id);
        $this->db->like('descricao', $descricao);
        $existSubcategoria = $this->db->get('subcategorias')->result_array();
        if(!empty($existSubcategoria)){
            return false;
        } else {
            $this->db->insert('subcategorias', array('categoria_id' => $categoria_id, 'descricao' => $descricao));
            if($this->db->affected_rows() > 0){
                return true;
            } else {
                return false;
            }
        }
    }

    public function getSubsByCatIdAndCursosPublicados($categoria_id){
        $this->db->select('s.*');
        $this->db->join('cursos c', 'c.subcategoria_id=s.id');
        $this->db->where('c.status', 1);
        $this->db->where('s.categoria_id', $categoria_id);
        $this->db->group_by('s.id');
        $this->db->order_by('s.descricao', 'asc');
        return $this->db->get('subcategorias s')->result_array();
    }

}