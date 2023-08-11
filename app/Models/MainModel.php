<?php namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model{


    public function list() : array{
        $db = \Config\Database::connect();
		$dados = $db->query("
		SELECT ID_clinica, Nome_fantasia_clinica
		FROM clinica
		")->getResultArray();
		$db->close();
        return $dados;
    }

	public function pegaimg($id) : array{
		$db = \Config\Database::connect();
		$dados = $db->query("
		SELECT foto_clinica, tipo_de_imagem_clinica
		FROM clinica
		WHERE ID_clinica = $id")->getResultArray();
		if(empty($dados)){
			return 0;
		}
		$db->close();
		return $dados[0];
	}

	

}