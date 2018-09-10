<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

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
        $this->db->select('c.*, u.nome, u.id as id_professor');
        $this->db->where('c.id', $id);
        $this->db->join('usuarios u', 'u.id=c.usuario_id');
        $curso = $this->db->get('cursos c')->row_array();
        return $curso;
    }

    public function ativar($id){
        $this->db->where('curso_id', $id);
        $countVideos = $this->db->get('videos')->result_array();
        if(sizeof($countVideos) > 0){
            $this->db->where('id', $id);
            $this->db->update('cursos', array('status' => 1));
            return true;
        } else {
            return false;
        }
    }

    public function desativar($id){
        $this->db->where('id', $id);
        $this->db->update('cursos', array('status' => 0));
        return true;
    }

    # Recupera todos os cursos ativos
    public function getCursos(){
        # Categorias
        $this->db->select('c.*');
        $this->db->join('subcategorias s', 's.categoria_id=c.id');
        $this->db->join('cursos', 'cursos.subcategoria_id=s.id');
        $this->db->where('cursos.status', 1);
        $categorias             = $this->db->order_by('c.descricao', 'asc')->get('categorias c')->result_array();
        $dados['categorias']    = '';
        $dados['subcategorias'] = '';
        if(!empty($categorias)){
            foreach($categorias as $categoria){
                $dados['categorias'][$categoria['id']]['cat_descricao'] = $categoria['descricao'];
                $this->db->select('s.*');
                $this->db->join('cursos', 'cursos.subcategoria_id=s.id');
                $this->db->where('cursos.status', 1);
                $this->db->group_by('s.id');
                $subcategorias = $this->db->order_by('s.descricao', 'asc')->where('s.categoria_id', $categoria['id'])->get('subcategorias s')->result_array();
                foreach($subcategorias as $subcategoria){
                    $dados['categorias'][$categoria['id']]['subcategorias'][$subcategoria['id']]['descricao'] = $subcategoria['descricao'];
                    $this->db->select('c.*, u.nome');
                    $this->db->join('usuarios u', 'u.id=c.usuario_id');
                    $dados['categorias'][$categoria['id']]['subcategorias'][$subcategoria['id']]['cursos'] = $this->db->order_by('c.titulo', 'asc')->where('c.status', 1)->where('c.subcategoria_id', $subcategoria['id'])->get('cursos c')->result_array();
                }
            }
        }
        return $dados;
    }

}