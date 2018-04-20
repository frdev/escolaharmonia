<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {

    public function professor($id){
        if(!empty($id)){
            redirect(base_url());
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
        $this->load->view('includes/header');
        $this->load->view('usuarios/perfil_professores/editar');
        $this->load->view('includes/footer');
    }
    
}
