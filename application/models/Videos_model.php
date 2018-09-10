<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Videos_model extends CI_Model {

    public function save($video){
        $this->db->insert('videos', $video);
        return $this->db->insert_id();
    }

    public function update($video, $id){
        $this->db->where('id', $id);
        $this->db->update('videos', $video);
        return $this->db->affected_rows();
    }

    public function getVideosByCursoId($curso_id){
        $this->db->where('curso_id', $curso_id);
        $this->db->order_by('created_at', 'asc');
        return $this->db->get('videos')->result_array();
    }

    public function getVideoById($id){
        $this->db->select('cv.*, c.titulo as curso_titulo');
        $this->db->where('cv.id', $id);
        $this->db->join('cursos c', 'c.id=cv.curso_id');
        return $this->db->get('videos cv')->row_array();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('videos');
        return $this->db->affected_rows();
    }

}