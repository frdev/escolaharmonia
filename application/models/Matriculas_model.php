<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Matriculas_model extends CI_Model {

    public function save($aluno_id, $curso_id){
        $this->db->insert('matriculas', array('aluno_id' => $aluno_id, 'curso_id' => $curso_id));
    }

    public function getMatriculasByCurso($limit, $start, $curso_id){
        $this->db->select('u.*');
        $this->db->where('cm.curso_id', $curso_id);
        $this->db->order_by('u.nome', 'asc');
        $this->db->join('usuarios u', 'u.id=cm.aluno_id');
        $this->db->limit($limit, $start);
        return $this->db->get('matriculas cm')->result_array();
    }

    public function getCountAllMatriculas($curso_id){
        $this->db->where('curso_id', $curso_id);
        $matriculas = $this->db->get('matriculas')->result_array();
        return sizeof($matriculas);
    }

}