<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class UserModel extends Model{
    
    public function __construct(){

        $this->db= \Config\Database::connect();
        $this->builder = $this->db->table('usuario');
    }

    public function cadastrarUsuario($parametros) : array{
        $db = \Config\Database::connect();
        
        $erros = [];

        $query = 'INSERT INTO `usuario`(`Nome_usuario`,`Senha_usuario`, `Email_usuario`, `Whatsapp_usuario`, `Telefone_usuario`)
         VALUES(:nome_usuario:, :senha: , :email:, :whatsapp:, :telefone:);';
        
        $dados = $this->db->query($query, $parametros);
        
        if($dados){
            $erros[] = "sucesso";
        }
        else{
            $erros[] = "Falha";
        }
    
        $this->db->close();
        return $erros;
    }


    public function check_usuario($parametros) {
        //$cpf = $parametros['cpf'];
        $email = $parametros['email'];
        
        $query = "SELECT * FROM usuario WHERE Email_usuario = '$email'";
        $resultado = $this->db->query($query, $parametros);
        return $resultado->getNumRows() > 0;
    }

    //dados usuarios| Perfil
    public function getUser($id){
        $this->builder->select('ID_usuario, Nome_usuario, Email_usuario, Whatsapp_usuario, Telefone_usuario');
        $query = $this->builder->getWhere(['ID_usuario' => $id])->getResultArray();
        $this->db->close();

        if($query!=null && $query!="")
            return $query[0];
        else
            return null;
	}
    public function getUserByEmail($email){
        $this->builder->select('ID_usuario, Nome_usuario');
        $query = $this->builder->getWhere(['Email_usuario' => $email])->getResultArray();
        $this->db->close();

        if($query!=null && $query!="")
            return $query[0];
        else
            return null;
	}

    public function login($email, $senha){
        $limit=1;
        $offset=0;

        $this->builder->select('ID_usuario, Nome_usuario');
        $query = $this->builder->getWhere(['Email_usuario' => $email, 'Senha_usuario' => $senha], $limit, $offset)->getResultArray();
        $this->db->close();
        return $query;
    }

    public function atualizar_cadastro($id,$dados){
        $this->builder->where(['ID_usuario' => $id, 'Senha_usuario' => $dados['Senha_usuario']]);

        //if($query = $this->builder->get()->getResultArray() == null)
        //    return false;

        if($this->builder->update($dados)){
            return true;
        }
        else{
            return false;
        }
        
    }

    public function excluir_cadastro($id, $senha){
        $this->builder->where(['ID_usuario' => $id, 'Senha_usuario' => $senha]);
        if($this->builder->delete()){
            return true;
        }
        else{
            return false;
        }
    }
/*
    public function check_usuario($cpf, $email) {
        $this->db->where('CPF_usuario', $cpf);
        $this->db->or_where('Nome_usuario', $email);
        $query = $this->db->get('usuario');
        return $query->result_array();  //AQui retornara com os arry com os registros
    }
*/
}