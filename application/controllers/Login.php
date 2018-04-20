<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index(){
        # Carrega a view da página de login
        $this->load->view('index');
    }

    public function signin(){
        # Inicializa a model
        $this->load->model('usuarios_model');
        # Instancia o array com os valores
        $login['email'] = $this->input->post('email');
        $login['senha'] = md5($this->input->post('senha'));
        # Checa se o usuário existe
        $user           = $this->usuarios_model->checkLogin($login);
        # Se teve retorno, true
        if(!empty($user)){
            $this->session->set_userdata('logged', $user);
            echo true;
        # Se não, false
        } else {
            echo false;
        }
    }

    public function signout(){
        $this->session->unset_userdata('logged');
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
