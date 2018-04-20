<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class perfil_professores_subcategorias_model extends CI_Model {

    public function getSubByProfessorId($id){
        $this->db->select('subcategoria_id');
        $this->db->where('usuario_id', $id);
        return $this->db->get('perfil_professores_subcategorias')->result_array();
    }

    public function getCategoryByProfessorId($id){
        $this->db->select('s.categoria_id');
        $this->db->where('pps.usuario_id', $id);
        $this->db->join('perfil_professores_subcategorias pps', 's.id = pps.subcategoria_id', 'left');
        return $this->db->group_by('s.categoria_id')->get('subcategorias s')->row_array();
    }

}