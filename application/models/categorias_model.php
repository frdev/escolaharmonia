<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class categorias_model extends CI_Model {

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

}