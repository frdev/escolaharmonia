<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class usuarios_model extends CI_Model {

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
                        $this->db->where('usuario_id', $usuario_id)->delete('perfil_professores_subcategorias');
                        foreach($usuario['subcategorias'] as $subcategoria){
                            $this->db->insert('perfil_professores_subcategorias', array('usuario_id' => $usuario_id, 'subcategoria_id' => $subcategoria));
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
                                $this->db->insert('perfil_professores_subcategorias', array('usuario_id' => $id, 'subcategoria_id' => $subcategoria));
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
        # Define os parâmetros do Where
        $where = array('email' => $login['email'], 'senha' => $login['senha'], 'status' => 1);
        # Define que só vai retornar apenas 1
        $this->db->where($where)->limit(1);
        # Retorna em forma de array os dados do banco
        return $this->db->get('usuarios')->row_array();
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