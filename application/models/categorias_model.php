<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

    public function getAll(){
        return $this->db->order_by('descricao', 'asc')->get('categorias')->result_array();
    }

    public function save($descricao){
        $this->db->like('descricao', $descricao);
        $existCategoria = $this->db->get('categorias')->result_array();
        if(!empty($existCategoria)){
            return false;
        } else {
            $this->db->insert('categorias', array('descricao' => $descricao));
            if($this->db->affected_rows() > 0){
                return true;
            } else {
                return false;
            }
        }
    }

    public function getCategoriasByCursosPublicados(){
        $this->db->select('c.*');
        $this->db->join('subcategorias s', 's.categoria_id=c.id');
        $this->db->join('cursos', 'cursos.subcategoria_id=s.id');
        $this->db->where('cursos.status', 1);
        $this->db->group_by('c.id');
        return $this->db->order_by('c.descricao', 'asc')->get('categorias c')->result_array();
    }

}