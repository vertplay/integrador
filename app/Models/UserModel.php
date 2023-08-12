<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{

    public function novoUsuario($parametros) : array{
        
        $erros = [];
        $db = \Config\Database::connect();
    
        $dados = $db->query('
            INSERT INTO usuarios
            (login, senha, nome, img, imgtype)
            VALUES(:login:, :senha:, :nome:, ":img:", :imgtype:)
            ', $parametros);
        if($dados){
            $erros[] .= "sucesso";
        }
        else{
            $erros[] .= "Falha";
        }
        $db->close();
        
        return $erros;
    }
    //dados usuarios| Perfil
    public function getUser($id) : array{
		$parametros = [
			'id_usuario' => $id
		];
        $db = \Config\Database::connect();
		$dados = $db->query("
			SELECT id, nome 
			FROM usuarios
			WHERE id = :id_usuario:
			", $parametros);
        $db->close();
        return $dados->getResultArray();
	}


    //THIAGO PARTE 
    public function inserir_usuario($dados) {
        $this->db->insert('usuario', $dados);
        return $this->db->insert_id();
    }

    public function check_usuario($cpf, $nome_completo) {
        $this->db->where('CPF_usuario', $cpf);
        $this->db->or_where('Nome_usuario', $nome_completo);
        $query = $this->db->get('usuario');
        return $query->result_array();  //AQui retornara com os arry com os registros
    }

}