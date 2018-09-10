<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('logged')){
            redirect(base_url('home/'));
        }
    }

    public function save(){
        # Variaveis de retorno para o JS
        $retorno['success'] = false;
        $retorno['message'] = 'Erro ao inserir vídeo aula.';
        # A posição vídeo inicia-se vazio pois será atualizado depois que for upado o arquivo
        $info_video = array(
            'curso_id'  => $this->input->post('curso_id'),
            'titulo'    => $this->input->post('titulo_video'),
            'descricao' => $this->input->post('descricao'),
            'video'     => $this->input->post('video')
        );
        # Carrega a model para inserir no BD
        $this->load->model('videos_model');
        $id = $this->videos_model->save($info_video);
        if(!empty($id)){
            $retorno['success'] = true;
            $retorno['message'] = 'Vídeo aula inserida com sucesso.';
        }
        echo json_encode($retorno);
    }

    public function update(){
        # Carrega model videos_model
        $this->load->model('videos_model');
        $post       = $this->input->post();
        # Informações do vídeo que serão atualizadas
        $info_video = array(
            'curso_id'  => $post['curso_id'],
            'titulo'    => $post['titulo_video'],
            'descricao' => $post['descricao'],
            'video'     => $post['video']
        );
        # Atualiza as info do BD
        $this->videos_model->update($info_video, $post['id']);
        $retorno['success'] = true;
        $retorno['message'] = 'Informações da vídeo aula atualizadas com sucesso.';
        echo json_encode($retorno);
    }

    public function delete(){
        # Carrega model videos_model
        $this->load->model('videos_model');
        # Válida se foi excluído do BD
        if($this->videos_model->delete($this->input->post('id')) > 0){
            $retorno['success'] = true;
            $retorno['message'] = 'Vídeo aula excluída.'; 
        }
        echo json_encode($retorno);
    }

}
