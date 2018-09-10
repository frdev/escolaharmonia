<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategorias extends CI_Controller {

    public function getSubcategorias(){
        # Carrega a model Subcategoria
        $this->load->model('subcategorias_model');
        # Recupera as subcategorias
        $subcategorias = $this->subcategorias_model->getSubByCategoryId($this->input->post('id'));
        # Retorna o Json
        echo json_encode($subcategorias);
    }

    public function save(){
        # Carrega Model
        $this->load->model('subcategorias_model');
        # Chama o método para inserção
        echo $this->subcategorias_model->save($this->input->post('categoria'), $this->input->post('subcategoria'));
    }

    public function getSubsByCatIdAndCursosPublicados(){
        $this->load->model('subcategorias_model');
        $subcategorias = $this->subcategorias_model->getSubsByCatIdAndCursosPublicados($this->input->post('categoria_id'));
        echo json_encode($subcategorias);
    }

}
