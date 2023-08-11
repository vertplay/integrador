<?php namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model{


    public function list() : array{
        $db = \Config\Database::connect();
		$dados = $db->query("
		SELECT id, nome
		FROM usuarios
		")->getResultArray();
		$db->close();
        return $dados;
    }

	public function pegaimg($id) : array{
		$db = \Config\Database::connect();
		$dados = $db->query("
		SELECT img, imgtype
		FROM usuario
		WHERE id = $id")->getResultArray();
		if(empty($dados)){
			return 0;
		}
		$db->close();
		return $dados[0];
	}

	

}