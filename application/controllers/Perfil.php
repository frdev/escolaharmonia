<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

    public function professor($id){
        if(empty($id)){
            redirect(base_url('home/'));
        }
        # Carrega Model
        $this->load->model('perfil_professores_model');
        # Retorna os dados para visualização do Perfil do Professor
        $dados = $this->perfil_professores_model->getProfessorById($id);
        $this->load->view('includes/header');
        $this->load->view('usuarios/perfil_professores/index', $dados);
        $this->load->view('includes/footer');
    }

    public function edit(){
        # Recupera os dados da sessao
        $acesso = $this->session->userdata('logged');
        # Carrega model
        $this->load->model('perfil_professores_formacoes_model');
        # Recupera formacoes
        $dados['formacoes'] = $this->perfil_professores_formacoes_model->getFormacoes($acesso['id']);
        # Carrega model
        $this->load->model('perfil_professores_model');
        $dados['biografia'] = $this->perfil_professores_model->getBiografia($acesso['id']);
        $this->load->view('includes/header');
        $this->load->view('usuarios/perfil_professores/editar', $dados);
        $this->load->view('includes/footer');
    }

    public function saveBiografia(){
        $biografia = array(
            'usuario_id' => $this->input->post('usuario_id'),
            'biografia'  => $this->input->post('biografia')
        );
        $this->load->model('perfil_professores_model');
        $retorno = $this->perfil_professores_model->save($biografia);
        echo json_encode($retorno);
    }

    public function saveFormacao(){
        $formacao = array(
            'usuario_id'     => $this->input->post('usuario_id'),
            'descricao'      => strtoupper($this->input->post('descricao')),
            'data_conclusao' => $this->input->post('conclusao')
        );
        # Carrega a model
        $this->load->model('perfil_professores_formacoes_model');
        $retorno = $this->perfil_professores_formacoes_model->save($formacao);
        echo json_encode($retorno);
    }

    public function deleteFormacao(){
        $this->load->model('perfil_professores_formacoes_model');
        $retorno = $this->perfil_professores_formacoes_model->delete($this->input->post('formacao_id'));
        echo json_encode($retorno);
    }
    
}
