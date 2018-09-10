<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('logged')){
            redirect(base_url('home/'));
        }
    }

    public function curso($id){
        # Carrega model cursos_model para recuperar infos do curso
        $this->load->model('cursos_model');
        $dados['curso']  = $this->cursos_model->getCursoById($id);
        # Carrega model videos_model para recuperar os vídeos
        $this->load->model('videos_model');
        $dados['videos'] = $this->videos_model->getVideosByCursoId($id);
        # Carrega a view da página
        $this->load->view('includes/header');
        $this->load->view('cursos/curso', $dados);
        $this->load->view('includes/footer');
    }

    public function video($curso_id, $video_id){
        # Carrega model cursos_model para recuperar infos do curso
        $this->load->model('cursos_model');
        $dados['curso']       = $this->cursos_model->getCursoById($curso_id);
        # Carrega model videos_model para recuperar os vídeos
        $this->load->model('videos_model');
        $dados['videos']      = $this->videos_model->getVideosByCursoId($curso_id);
        $dados['video_atual'] = $this->videos_model->getVideoById($video_id);
        # Carrega a view da página
        $this->load->view('includes/header');
        $this->load->view('cursos/video', $dados);
        $this->load->view('includes/footer');
    }

    public function index(){
        # Recupera os cursos
        $this->load->model('cursos_model');
        $dados['cursos']               = $this->cursos_model->getCursos();
        # Recupera as categorias para poder realizar o filtro
        $this->load->model('categorias_model');
        $dados['select_categorias']    = $this->categorias_model->getCategoriasByCursosPublicados();

        $acesso = $this->session->userdata('logged');
        if($acesso['tipo'] == 'ALUNO'){
            $this->load->model('usuarios_model');
            # Recupera os cursos matriculados do aluno
            $dados['cursos_aluno'] = $this->usuarios_model->getIdCursosMatriculadosByAluno($acesso['id']);
        }
        # Carrega a view da página
        $this->load->view('includes/header');
        $this->load->view('cursos/publicados', $dados);
        $this->load->view('includes/footer');
    }

    public function matricula(){
        $acesso = $this->session->userdata('logged');
        $this->load->model('matriculas_model');
        $this->matriculas_model->save($acesso['id'], $this->input->post('curso_id'));
        echo true;
    }

    public function publicar(){
        $acesso = $this->session->userdata('logged');
        if($acesso['tipo'] != 'PROFESSOR'){
            redirect(base_url('home/'));
        }
        # Carrega a biblioteca do pagination
        $this->load->library('pagination');

        $this->load->model('cursos_model');
        # Configurando os link do pagination
        $params         = array();
        $limit_per_page = 10;
        $page           = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) : 0;
        $total_records  = $this->cursos_model->getCountAll($acesso['id']);
        if($total_records > 0){
            # Pega a pagina atual
            $params["results"]     = $this->cursos_model->getCurrentPage($limit_per_page, $page*$limit_per_page, $acesso['id']);
                
            $config['base_url']    = base_url() . 'cursos/publicar/';
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
            $dados = array('cursos' => $params['results'], 'links' => $params['links']);
        } else {
            $dados = array('cursos' => array(), 'links' => array());
        }

        # Carrega a model professores_subcategorias_model para poder recuperar os dados de subcategorias
        $this->load->model('professores_subcategorias_model');
        # Recupera as subcategorias que o professor da aula
        $subcategorias              = $this->professores_subcategorias_model->getSubByProfessorId($acesso['id']);
        $dados['subcategorias'][''] = 'Selecione...';
        foreach($subcategorias as $sub){
            $dados['subcategorias'][$sub['subcategoria_id']] = $sub['descricao'];
        }

        # Instancia os níveis para poder mencionar ao curso
        $dados['niveis'][0] = 'Básico';
        $dados['niveis'][1] = 'Intermediário';
        $dados['niveis'][2] = 'Avançado';

        # Carrega a view da página
        $this->load->view('includes/header');
        $this->load->view('cursos/publicar', $dados);
        $this->load->view('includes/footer');
    }

    public function save(){
        # Instancia a variavel acesso com a sessao
        $acesso = $this->session->userdata('logged');
        # Monta o array de cursos para inserção
        $curso  = array(
            'usuario_id'      => $acesso['id'],
            'subcategoria_id' => $this->input->post('subcategoria_id'),
            'nivel'           => $this->input->post('nivel'),
            'titulo'          => $this->input->post('titulo'),
            'descricao'       => $this->input->post('descricao_curso')
        );
        # Carrega a model
        $this->load->model('cursos_model');
        $id = $this->input->post('id');
        if(!empty($id)){
            $retorno = $this->cursos_model->save($curso, $id);
        } else {
            $retorno = $this->cursos_model->save($curso);
        }
        echo json_encode($retorno);
    }

    public function edit($id){
        $acesso = $this->session->userdata('logged');
        if($acesso['tipo'] != 'PROFESSOR'){
            redirect(base_url('home/'));
        }
        # Carrega a biblioteca do pagination
        $this->load->library('pagination');
        # Carrega a model
        $this->load->model('cursos_model');
        $dados['curso'] = $this->cursos_model->getCursoById($id);
        # Carrega a model professores_subcategorias_model para poder recuperar os dados de subcategorias
        $this->load->model('professores_subcategorias_model');
        # Carre model matriculas_model para recuperar os alunos matriculados
        $this->load->model('matriculas_model');
        # Configurando os link do pagination
        $params         = array();
        $limit_per_page = 10;
        $page           = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) : 0;
        $total_records  = $this->matriculas_model->getCountAllMatriculas($id);
        if($total_records > 0){
            # Pega a pagina atual
            $params["results"]     = $this->matriculas_model->getMatriculasByCurso($limit_per_page, $page*$limit_per_page, $id);
                
            $config['base_url']    = base_url() . 'cursos/edit/';
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
            $dados['matriculas'] = $params['results'];
            $dados['link']       = $params['links'];
        } else {
            $dados['matriculas'] = [];
            $dados['link']       = [];
        }

        # Recupera as subcategorias que o professor da aula
        $dados['subcategorias'] = $this->professores_subcategorias_model->getSubByProfessorId($acesso['id']);
        # Instancia os níveis para poder mencionar ao curso
        $dados['niveis'][0] = 'Básico';
        $dados['niveis'][1] = 'Intermediário';
        $dados['niveis'][2] = 'Avançado';
        # Carrega a model videos_model
        $this->load->model('videos_model');
        $dados['videos']    = $this->videos_model->getVideosByCursoId($id);
        $this->load->view('includes/header');
        $this->load->view('cursos/edit', $dados);
        $this->load->view('includes/footer');
    }

    public function video_edit($id){
        $this->load->model('videos_model');
        $dados['video'] = $this->videos_model->getVideoById($id);
        $this->load->view('includes/header');
        $this->load->view('cursos/video/edit', $dados);
        $this->load->view('includes/footer');
    }

    public function ativar(){
        # Carrega a model
        $this->load->model('cursos_model');
        echo $this->cursos_model->ativar($this->input->post('id'));
    }

    public function desativar(){
        # Carrega a model
        $this->load->model('cursos_model');
        echo $this->cursos_model->desativar($this->input->post('id'));
    }

}
