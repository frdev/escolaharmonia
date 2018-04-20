<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if($this->session->has_userdata('logged')){
            redirect(base_url());
        }
    }

    public function index(){
        # Carrega a view da página
        $this->load->view('includes/header');
        $this->load->view('categorias/categorias', $dados);
        $this->load->view('includes/footer');
    }

    public function save(){
        # Carrega Model
        $this->load->model('categorias_model');
        # Chama o método para inserção
        echo $this->categorias_model->save($this->input->post('descricao'));
    }

}
