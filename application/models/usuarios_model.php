<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function getAll(){
        return $this->db->get('usuarios')->result_array();
    }

    public function getUserByIdToEdit($id){
        $this->db->select('id, nome, email, nivel_id');
        $this->db->where('id', $id);
        return $this->db->get('usuarios')->row_array();
    }

    public function getCountAll($nivel_id){
        $this->db->where(array('nivel_id' => $nivel_id));
        $users = $this->db->get('usuarios')->result_array();
        return sizeof($users);
    }

    public function getCurrentPage($limit, $start, $nivel_id){
        $this->db->limit($limit, $start);
        $this->db->where(array('nivel_id' => $nivel_id));
        return $this->db->get('usuarios')->result_array();
    }

    public function getIdCursosMatriculadosByAluno($usuario_id){
        $this->db->where('aluno_id', $usuario_id);
        $cursos     = $this->db->get('matriculas')->result_array();
        $matriculas = [];
        foreach($cursos as $curso){
            $matriculas[] = $curso['curso_id'];
        }
        return $matriculas;
    }

    # Função para salvar a atualização ou a inserção de Usuários
    public function save($usuario, $usuario_id=null){
        try {
            if(!empty($usuario_id)){
                $this->db->where("id != " . $usuario_id . " AND (nome LIKE '" . $usuario['usuario']['nome'] . "' OR email LIKE '" . $usuario['usuario']['email'] . "')");
                $exist = $this->db->get('usuarios')->result_array();
                if(empty($exist)){
                    $this->db->where('id', $usuario_id);
                    $this->db->update('usuarios', $usuario['usuario']);
                    # Valida se é perfil de professor para inserir as subcategorias
                    if($usuario['usuario']['nivel_id'] == 2){
                        $this->db->where('usuario_id', $usuario_id)->delete('professores_subcategorias');
                        foreach($usuario['subcategorias'] as $subcategoria){
                            $this->db->insert('professores_subcategorias', array('usuario_id' => $usuario_id, 'subcategoria_id' => $subcategoria));
                        }
                    }
                    $retorno['message'] = 'Usuário atualizado com sucesso.';
                    $retorno['success'] = true;
                } else {
                    $retorno['message'] = 'Usuário já existe com essas credenciais, por favor, tente novamente com outras.';
                    $retorno['success'] = false;
                }
            } else {
                $this->db->where("nome LIKE '". $usuario['usuario']['nome'] . "' OR email LIKE '" . $usuario['usuario']['email'] . "'");
                $exist = $this->db->get('usuarios')->result_array();
                if(empty($exist)){
                    # Insere usuário
                    $this->db->insert('usuarios', $usuario['usuario']);
                    $id = $this->db->insert_id();
                    # Valida se foi inserido
                    if(!empty($id)){
                        # Valida se é perfil de professor para inserir as subcategorias
                        if($usuario['usuario']['nivel_id'] == 2){
                            foreach($usuario['subcategorias'] as $subcategoria){
                                $this->db->insert('professores_subcategorias', array('usuario_id' => $id, 'subcategoria_id' => $subcategoria));
                            }
                        }
                        $retorno['message'] = 'Usuário cadastrado com sucesso.';
                        $retorno['success'] = true;
                    } else {
                        $retorno['message'] = 'Erro ao inserir usuário.';
                        $retorno['success'] = false;
                    }
                } else {
                    $retorno['message'] = 'Usuário já existe com essas credenciais, por favor, tente novamente com outras.';
                    $retorno['success'] = false;
                }
            }
            return json_encode($retorno);
        } catch (Exception $e){
            $retorno['message'] = 'Erro ao salvar informações do Usuário.';
            $retorno['message'] = false;
            return json_encode($retorno);
        }
    }

    public function getLevelsAccess(){
        return $this->db->get('niveis_acesso')->result_array();
    }

    public function checkLogin($login){
        if($login['tipo_login'] == 'aluno'){
            # Inicializa a conexão com a database de Contratos
            $this->db_login = $this->load->database('login', TRUE);
            $login['contrato'] = strtoupper($login['contrato']);
            if($login['tipo'] == 'TITULAR') {
                $tipo = 'cpf';
                $dado = str_replace(array('.', '-'), array('', ''), $login['dado']);
                $user = $this->db_login->select('c.*, t.id associado_id, t.nome, t.cpf dado')->join('contratos c', 't.contrato_id=c.id')->like('c.codigo', $login['contrato'], 'none')->like('t.cpf', $dado, 'none')->get('titulares t')->row_array();
            } else {
                $tipo = 'nascimento';
                $aux  = explode('/', $login['dado']);
                $dado = $aux[2] . '-' . $aux[1] . '-' . $aux[0];
                $user = $this->db_login->select('c.*, d.id associado_id, d.nome, d.nascimento dado')->join('contratos c', 'd.contrato_id=c.id')->like('c.codigo', $login['contrato'], 'none')->like('d.nascimento', $dado, 'none')->get('dependentes d')->row_array();
            }
            # Valida se existe
            if(!empty($user)){
                $infos = [
                    'tipo'     => $login['tipo'],
                    'nome'     => $user['nome'],
                    'contrato' => $user['codigo'],
                    'empresa'  => $user['empresa'],
                    $tipo      => $user['dado'],
                    'status'   => $user['status']
                ];
                $aux = $this->db->like('tipo', $login['tipo'], 'none')->like($tipo, $user['dado'])->like('empresa', $user['empresa'])->like('contrato', $user['codigo'])->get('alunos')->row_array();
                if(!empty($aux)){
                    $this->db->where('id', $aux['id'])->update('alunos', $infos);
                } else {
                    $this->db->insert('alunos', $infos);
                    $aux['id'] = $this->db->insert_id();
                }
                $usuario         = $this->db->where('id', $aux['id'])->get('alunos')->row_array();
                $usuario['tipo'] = 'ALUNO';
            } else {
                $usuario = [];
            }
        } else {
            $usuario         = $this->db->like('email', $login['email'], 'none')->like('senha', md5($login['senha']))->get('usuarios')->row_array();
            $usuario['tipo'] = $usuario['nivel_id'] == 1 ? 'ADMIN' : 'PROFESSOR';
        }
        return $usuario;
    }

    public function getUsuarioDigital($id, $tipo){
        $db_login = $this->load->database('login', TRUE);
        if($tipo == 'titular'){
            $resultado = $db_login->select('c.*, t.id associado_id, t.nome, t.cpf, t.nascimento')->join('contratos c', 't.contrato_id=c.id')->where('t.id', $id)->get('titulares t')->row_array();
            $usuario = [
                'contrato' => $resultado['codigo'],
                'dado'     => $resultado['cpf'],
                'tipo'     => 'TITULAR'
            ];
        } else {
            $resultado = $db_login->select('c.*, d.id associado_id, d.nome, d.nascimento, d.cpf')->join('contratos c', 'd.contrato_id=c.id')->where('d.id', $id)->get('dependentes d')->row_array();
            $usuario = [
                'contrato' => $resultado['codigo'],
                'dado'     => $resultado['nascimento'],
                'tipo'     => 'DEPENDENTE'
            ];
        }
        $usuario['tipo_login'] = 'aluno';
        $retorno               = $this->checkLogin($usuario);
        return $retorno;
    }

    public function changeStatus($id, $status){
        # Valida o status novo
        $new_status = $status == 1 ? 0 : 1;
        # Realiza o Update
        $this->db->set('status', $new_status);
        $this->db->where('id', $id);
        $this->db->update('usuarios');
        # Retorna a quantidade de linhas que foram afetadas
        return $this->db->affected_rows();
    }

}