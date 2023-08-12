<?php namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model{

	public function list() : array {
		$db = \Config\Database::connect();
		$dados = $db->query("
			SELECT c.ID_clinica, c.Nome_fantasia_clinica, AVG(a.Nota_avaliacao) AS Media_Avaliacao
			FROM clinica c
			INNER JOIN avalia_avaliacao a ON c.ID_clinica = a.ID_clinica
			GROUP BY c.ID_clinica, c.Nome_fantasia_clinica
			ORDER BY Media_Avaliacao DESC
		")->getResultArray();
		$db->close();
		return $dados;
	}
	
	public function pegaimg($id) : array {
		$db = \Config\Database::connect();
		$dados = $db->query("
			SELECT foto_clinica, tipo_de_imagem_clinica
			FROM clinica
			WHERE ID_clinica = $id
		")->getResultArray();
		if(empty($dados)){
			return 0;
		}
		$db->close();
		return $dados[0];
	}

	public function pesquisar($termo) {
		$db = \Config\Database::connect();
		$dados = $db->query("
			SELECT c.ID_clinica, c.Nome_fantasia_clinica, AVG(a.Nota_avaliacao) AS Media_Avaliacao
			FROM clinica c
			INNER JOIN avalia_avaliacao a ON c.ID_clinica = a.ID_clinica
			WHERE c.Nome_fantasia_clinica LIKE '%$termo%'
			OR c.Especialidade_clinica LIKE '%$termo%'
			OR c.Convenio_clinica LIKE '%$termo%'
			GROUP BY c.ID_clinica, c.Nome_fantasia_clinica
			ORDER BY Media_Avaliacao DESC
		")->getResultArray();
		$db->close();
		return $dados;
	}
		
}

