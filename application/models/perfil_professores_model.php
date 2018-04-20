<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class perfil_professores_model extends CI_Model {

    # Carrega as informações do Professor para visualização do Portfolio
    public function getProfessorById($id){
        # Recupera Bibliografia, nome e email
        $this->db->select('u.nome, u.email, pp.biografia');
        $this->db->where('u.id', $id);
        $this->db->join('perfil_professores pp', 'u.id = pp.usuario_id', 'left');
        $dados['professor']     = $this->db->get('usuarios u')->row_array();
        # Recupera as formações
        $this->db->select('descricao, data_conclusao');
        $this->db->where('usuario_id', $id);
        $dados['formacoes']     = $this->db->get('perfil_professores_formacoes')->result_array();
        # Recupera as categorias/subcategorias
        $this->db->select('s.descricao');
        $this->db->where('usuario_id', $id);
        $dados['subcategorias'] = $this->db->get('perfil_professores_subcategorias')->result_array();
        return $dados;
    }

    public function save($descricao){
        
    }

}