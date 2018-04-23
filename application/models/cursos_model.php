<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class cursos_model extends CI_Model {

    public function getCountAll($id){
        $this->db->where('usuario_id', $id);
        $cursos = $this->db->get('cursos')->result_array();
        return sizeof($cursos);
    }

    public function save($curso, $id=NULL){
        try{
            if(!empty($id)){
                $this->db->where('id', $id);
                $this->db->update('cursos', $curso);
                $retorno['message'] = 'Curso atualizado com sucesso.';
            } else {
                $this->db->insert('cursos', $curso);
                $retorno['message'] = 'Curso criado com sucesso.';
            }
            $retorno['success'] = true;
            return $retorno;
        } catch (Exception $e) {
            $retorno['message'] = 'Erro ao salvar Curso.';
            $retorno['success'] = false;
            return $retorno;
        }
    }

    public function getCurrentPage($limit, $start, $id){
        $this->db->select('c.*, s.descricao as descricao_sub');
        $this->db->where('c.usuario_id', $id);
        $this->db->limit($limit, $start);
        $this->db->join('subcategorias s', 's.id=c.subcategoria_id');
        return $this->db->order_by('c.titulo', 'asc')->get('cursos c')->result_array();
    }

    public function getCursoById($id){
        $this->db->where('id', $id);
        $curso = $this->db->get('cursos')->row_array();
        return $curso;
    }

}