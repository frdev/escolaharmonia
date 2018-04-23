<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class cursos_videos_model extends CI_Model {

    public function save($curso){

    }

    public function getVideosByCursoId($curso_id){
        $this->db->where('curso_id', $curso_id);
        return $this->db->get('cursos_videos')->result_array();
    }

}