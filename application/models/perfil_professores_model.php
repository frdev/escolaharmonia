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
        # Recupera as categorias/subcategorias através de model perfil_professores_subcategorias_model
        $this->load->model('perfil_professores_subcategorias_model');
        $dados['subcategorias'] = $this->perfil_professores_subcategorias_model->getSubByProfessorId($id);
        $dados['categoria']     = $this->perfil_professores_subcategorias_model->getCategoryByProfessorId($id);
        return $dados;
    }

    public function getBiografia($id){
        $this->db->where('usuario_id', $id);
        return $this->db->get('perfil_professores')->row_array();
    }

    public function save($biografia){
        $this->db->where('usuario_id', $biografia['usuario_id']);
        $exist = $this->db->get('perfil_professores')->row_array();
        if(!empty($exist)){
            try {
                $this->db->where('usuario_id', $biografia['usuario_id']);
                $this->db->update('perfil_professores', array('biografia' => $biografia['biografia']));
                $retorno['message'] = 'Biografia atualizada com sucesso.';
                $retorno['success'] = true;
                return $retorno;
            } catch (Exception $e) {
                $retorno['message'] = 'Erro ao atualizar biografia.';
                $retorno['success'] = false;
                return $retorno;
            }
        } else {
            try {
                $this->db->insert('perfil_professores', $biografia);
                $retorno['message'] = 'Biografia cadastrada com sucesso.';
                $retorno['success'] = true;
                return $retorno;
            } catch (Exception $e) {
                $retorno['message'] = 'Erro ao cadastrar biografia.';
                $retorno['success'] = false;
                return $retorno;
            }
        }
    }

}