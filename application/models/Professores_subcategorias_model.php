<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Professores_subcategorias_model extends CI_Model {

    public function getSubByProfessorId($id){
        $this->db->select('pps.subcategoria_id, s.descricao');
        $this->db->where('pps.usuario_id', $id);
        $this->db->join('subcategorias s', 's.id = pps.subcategoria_id', 'left');
        return $this->db->get('professores_subcategorias pps')->result_array();
    }

    public function getCategoryByProfessorId($id){
        $this->db->select('s.categoria_id, c.descricao');
        $this->db->where('pps.usuario_id', $id);
        $this->db->join('categorias c', 'c.id = s.categoria_id', 'left');
        $this->db->join('professores_subcategorias pps', 's.id = pps.subcategoria_id', 'left');
        return $this->db->group_by('s.categoria_id')->get('subcategorias s')->row_array();
    }

}