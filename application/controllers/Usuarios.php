<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    function __construct(){
        parent::__construct();
        $acesso = $this->session->userdata('logged');
        if($acesso['nivel_id'] != 1){
            redirect(base_url('home/'));
        }
    }

    public function customers()
    {
        # Carrega a biblioteca do pagination
        $this->load->library('pagination');
        # Carrega a Model
        $this->load->model('usuarios_model');
        # Configurando os link do pagination
        $params         = array();
        $limit_per_page = 10;
        $page           = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) : 0;
        $total_records  = $this->usuarios_model->getCountAll(1);
        if($total_records > 0){
            # Pega a pagina atual
            $params["results"]     = $this->usuarios_model->getCurrentPage($limit_per_page, $page*$limit_per_page, 1);
            $config['base_url']    = base_url() . 'usuarios/costumers/';
            $config['total_rows']  = $total_records;
            $config['per_page']    = $limit_per_page;
            $config["uri_segment"] = 3;
             
            # Customizando a configuração das páginas
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            
            $config['first_link']         = '<<';
            $config['first_tag_open']     = '<li><span class="firstlink">';
            $config['first_tag_close']    = '</span>';
            
            $config['last_link']          = '>>';
            $config['last_tag_open']      = '<li><span class="lastlink">';
            $config['last_tag_close']     = '</span></li>';
            
            $config['next_link']          = '>';
            $config['next_tag_open']      = '<li><span class="nextlink">';
            $config['next_tag_close']     = '</span></li>';
            
            $config['prev_link']          = '<';
            $config['prev_tag_open']      = '<li><span class="prevlink">';
            $config['prev_tag_close']     = '</span></li>';
            
            $config['cur_tag_open']       = '<li class="active"><span class="curlink">';
            $config['cur_tag_close']      = '</span></li>';
            
            $config['num_tag_open']       = '<li><span class="numlink">';
            $config['num_tag_close']      = '</span></li>';
             
            $this->pagination->initialize($config);
                 
            # Gera os links
            $params["links"] = $this->pagination->create_links();
        }
        $dados           = array('usuarios' => $params['results'], 'links' => $params['links']);
        # Carrega sessão para transferir pra view
        $dados['logged'] = $this->session->userdata('logged');
        $this->load->view('includes/header');
        $this->load->view('usuarios/customers', $dados);
        $this->load->view('includes/footer');
    }

    public function professores()
    {
        # Carrega a biblioteca do pagination
        $this->load->library('pagination');
        # Carrega a Model
        $this->load->model('usuarios_model');
        # Configurando os link do pagination
        $params         = array();
        $limit_per_page = 10;
        $page           = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) : 0;
        $total_records  = $this->usuarios_model->getCountAll(2);
        if($total_records > 0){
            # Pega a pagina atual
            $params["results"]     = $this->usuarios_model->getCurrentPage($limit_per_page, $page*$limit_per_page, 2);
            $config['base_url']    = base_url() . 'usuarios/professores/';
            $config['total_rows']  = $total_records;
            $config['per_page']    = $limit_per_page;
            $config["uri_segment"] = 3;
             
            # Customizando a configuração das páginas
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            
            $config['first_link']         = '<<';
            $config['first_tag_open']     = '<li><span class="firstlink">';
            $config['first_tag_close']    = '</span>';
            
            $config['last_link']          = '>>';
            $config['last_tag_open']      = '<li><span class="lastlink">';
            $config['last_tag_close']     = '</span></li>';
            
            $config['next_link']          = '>';
            $config['next_tag_open']      = '<li><span class="nextlink">';
            $config['next_tag_close']     = '</span></li>';
            
            $config['prev_link']          = '<';
            $config['prev_tag_open']      = '<li><span class="prevlink">';
            $config['prev_tag_close']     = '</span></li>';
            
            $config['cur_tag_open']       = '<li class="active"><span class="curlink">';
            $config['cur_tag_close']      = '</span></li>';
            
            $config['num_tag_open']       = '<li><span class="numlink">';
            $config['num_tag_close']      = '</span></li>';
             
            $this->pagination->initialize($config);
                 
            # Gera os links
            $params["links"] = $this->pagination->create_links();
        }
        $dados               = array('usuarios' => $params['results'], 'links' => $params['links']);
        # Recupera as categorias
        $dados['categorias'][''] = 'Selecione...';
        $this->load->model('categorias_model');
        $categorias = $this->categorias_model->getAll();
        foreach($categorias as $categoria){
            $dados['categorias'][$categoria['id']] = $categoria['descricao'];
        }
        $this->load->view('includes/header');
        $this->load->view('usuarios/professores', $dados);
        $this->load->view('includes/footer');
    }

    public function alunos()
    {
        # Carrega a biblioteca do pagination
        $this->load->library('pagination');
        # Carrega a Model
        $this->load->model('usuarios_model');
        # Configurando os link do pagination
        $params         = array();
        $limit_per_page = 10;
        $page           = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) : 0;
        $total_records  = $this->usuarios_model->getCountAll(3);
        if($total_records > 0){
            # Pega a pagina atual
            $params["results"]     = $this->usuarios_model->getCurrentPage($limit_per_page, $page*$limit_per_page, 3);
            $config['base_url']    = base_url() . 'usuarios/professores/';
            $config['total_rows']  = $total_records;
            $config['per_page']    = $limit_per_page;
            $config["uri_segment"] = 3;
             
            # Customizando a configuração das páginas
            $config['num_links']          = 2;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;
            
            $config['full_tag_open']      = '<ul class="pagination">';
            $config['full_tag_close']     = '</ul>';
            
            $config['first_link']         = '<<';
            $config['first_tag_open']     = '<li><span class="firstlink">';
            $config['first_tag_close']    = '</span>';
            
            $config['last_link']          = '>>';
            $config['last_tag_open']      = '<li><span class="lastlink">';
            $config['last_tag_close']     = '</span></li>';
            
            $config['next_link']          = '>';
            $config['next_tag_open']      = '<li><span class="nextlink">';
            $config['next_tag_close']     = '</span></li>';
            
            $config['prev_link']          = '<';
            $config['prev_tag_open']      = '<li><span class="prevlink">';
            $config['prev_tag_close']     = '</span></li>';
            
            $config['cur_tag_open']       = '<li class="active"><span class="curlink">';
            $config['cur_tag_close']      = '</span></li>';
            
            $config['num_tag_open']       = '<li><span class="numlink">';
            $config['num_tag_close']      = '</span></li>';
             
            $this->pagination->initialize($config);
                 
            # Gera os links
            $params["links"] = $this->pagination->create_links();
        }
        $dados           = array('usuarios' => $params['results'], 'links' => $params['links']);
        # Carrega sessão para transferir pra view
        $dados['logged'] = $this->session->userdata('logged');
        $this->load->view('includes/header');
        $this->load->view('usuarios/alunos', $dados);
        $this->load->view('includes/footer');
    }

    public function save()
    {
        # Cria Array do usuário
        $usuario['usuario'] = array(
            'nome'     => $this->input->post('nome'),
            'email'    => $this->input->post('email'),
            'nivel_id' => $this->input->post('nivel_acesso')
        );
        # Carrega as subcategorias do professor
        if($usuario['usuario']['nivel_id'] == 2){
            $usuario['subcategorias'] = $this->input->post('subcategoria_id');
        }
        # Carrega Model do Usuário
        $this->load->model('usuarios_model');
        # Salva/atualiza usuário
        if($this->input->post('id')){
            if(!empty($this->input->post('senha'))){
                $usuario['usuario']['senha'] = md5($this->input->post('senha'));
            }
            echo $this->usuarios_model->save($usuario, $this->input->post('id'));
        } else {
            $usuario['usuario']['senha'] = md5($this->input->post('senha'));
            echo $this->usuarios_model->save($usuario);
        }
    }

    public function changeStatus(){
        # Carrega a model
        $this->load->model('usuarios_model');
        # Chama a função para poder atualizar
        $update = $this->usuarios_model->changeStatus($this->input->post('id'), $this->input->post('status'));
        # Se teve retorno, valida o update
        if($update){
            echo true;
        }
        echo false;
    }

    public function edit($id){
        # Direciona para home se o ID for vazio
        if(empty($id)){
            redirect(base_url('home/'));
        }
        # Recupera os dados do usuário
        $this->load->model('usuarios_model');
        $dados['usuario'] = $this->usuarios_model->getUserByIdToEdit($id);
        # Se o usuário for professor, recupera os dados de categorias/subcategorias
        if($dados['usuario']['nivel_id'] == 2){
            # Model das cat/subs do professor
            $this->load->model('perfil_professores_subcategorias_model');
            $dados['usuario']['categoria']     = $this->perfil_professores_subcategorias_model->getCategoryByProfessorId($id);
            $subs_prof                         = $this->perfil_professores_subcategorias_model->getSubByProfessorId($id);
            $dados['usuario']['subcategorias'] = [];
            foreach($subs_prof as $sub) :
                $dados['usuario']['subcategorias'][] = $sub['subcategoria_id']; 
            endforeach;
            # Carrega a model da categorias
            $this->load->model('categorias_model');
            $dados['categorias']    = $this->categorias_model->getAll();
            # Carrega a model da subcategorias
            $this->load->model('subcategorias_model');
            $dados['subcategorias'] = $this->subcategorias_model->getSubByCategoryId($dados['usuario']['categoria']['categoria_id']);
        }
        # Monta a view
        $this->load->view('includes/header');
        $this->load->view('usuarios/edit', $dados);
        $this->load->view('includes/footer');
    }
}
