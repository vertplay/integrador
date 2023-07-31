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
    //Musicas do usuario| Perfil
	public function GetMusicas($id) : array{
        $parametros = [
			'id_usuario' => $id
		];
        $db = \Config\Database::connect();
        $dados = $db->query("
			SELECT nome, arquivo 
			FROM musicas
			WHERE iduser = :id_usuario:
			", $parametros);
		$db->close();
        return $dados->getResultArray();
	}

}