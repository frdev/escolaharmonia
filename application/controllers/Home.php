<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('logged')){
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }

    public function index(){
        $acesso = $this->session->userdata('logged');
        redirect('cursos/');
    }
}

?>