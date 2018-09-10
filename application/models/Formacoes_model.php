<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Formacoes_model extends CI_Model {

    public function save($formacao){
        try {
            $this->db->insert('formacoes', $formacao);
            $retorno['message'] = 'Formação cadastrada com sucesso.';
            $retorno['success'] = true;
            return $retorno;
        } catch (Exception $e) {
            $retorno['message'] = 'Erro ao cadastrar formação.';
            $retorno['success'] = false;
            return $retorno;
        }
    }

    public function delete($formacao_id){
        try {
            $this->db->where('id', $formacao_id)->delete('formacoes');
            $retorno['message'] = 'Formação excluída com sucesso.';
            $retorno['success'] = true;
            return $retorno;
        } catch (Exception $e) {
            $retorno['message'] = 'Erro ao excluída formação.';
            $retorno['success'] = false;
            return $retorno;
        }
    }

    public function getFormacoes($usuario_id){
        $this->db->where('usuario_id', $usuario_id);
        return $this->db->order_by('data_conclusao', 'asc')->get('formacoes')->result_array();
    }

}