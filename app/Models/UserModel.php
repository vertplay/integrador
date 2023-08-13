<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class UserModel extends Model{
  
    public function cadastrarUsuario($parametros) : array{
        $db = \Config\Database::connect();
        
        $erros = [];

        $query = 'INSERT INTO `usuario`(`Nome_usuario`, `Nome_completo_usuario`, `Senha_usuario`, `CPF_usuario`, `Data_nascimento_usuario`, `Genero_usuario`, `Email_usuario`, `Whatsapp_usuario`, `Telefone_usuario`, `RG_usuario`, `Logradouro`, `Numero`, `Bairro`, `CEP`)
         VALUES(:nome_usuario:, :nome_completo:, :senha: , :cpf:, :data_nascimento:, :genero:, :email:, :whatsapp:, :telefone:, :rg:, :logradouro:, :numero:, :bairro:, :cep:);';
        
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
        $cpf = $parametros['cpf'];
        $email = $parametros['email'];
        
        $query = "SELECT * FROM usuario WHERE CPF_usuario = '$cnpj' OR Email_usuario = '$email'";
        $resultado = $this->db->query($query, $parametros);
        return $resultado->getNumRows() > 0;
    }

    //dados usuarios| Perfil
    public function getUser($id) : array{
		$parametros = [
			'id_usuario' => $id
		];
        $db = \Config\Database::connect();
		$dados = $db->query("
			SELECT id, nome 
			FROM usuario
			WHERE id = :id_usuario:
			", $parametros);
        $db->close();
        return $dados->getResultArray();
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