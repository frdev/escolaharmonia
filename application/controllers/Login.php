<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function admin(){
        # Carrega a view da página de login
        $this->load->view('login/administrativo');
    }

    public function alunos(){
        if(isset($_GET) && !empty($_GET['id']) && !empty($_GET['tipo'])){
            $db_login = $this->load->database('login', TRUE);
            $this->load->model('usuarios_model');
            # Recupera da outra base os dados e salva caso nao exista o usuario, se obter êxito, direciona para a pagina de home
            $user = $this->usuarios_model->getUsuarioDigital($_GET['id'], $_GET['tipo']);
            if(!empty($user)){
                $this->session->set_userdata('logged', $user);
                redirect(base_url('cursos/'));
            }
        }
        # Carrega a view da página de login
        $this->load->view('login/alunos');
    }

    public function signin(){
        # Inicializa a model
        $this->load->model('usuarios_model');
        $post = $this->input->post();
        $user = $this->usuarios_model->checkLogin($post);
        # Se teve retorno, true
        if(!empty($user)){
            $this->session->set_userdata('logged', $user);
            echo TRUE;
        # Se não, false
        } else {
            echo FALSE;
        }
    }

    public function signout(){
        $this->session->unset_userdata('logged');
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
