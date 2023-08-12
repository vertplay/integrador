<?php namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model{
	protected $db, $builder;

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
	public function setCodeRecuperacao($id, $codigo, $tipo, $datarec, $validade){
		$dados;
		if($tipo == 'pe'){
			$dados = [
				
				
				'ID_clinica '       		=> $id,
				'Codigo_recuperacao'        => $codigo,
				'Tipo_recuperacao'        => $tipo,
				'Validade_recuperacao'		=> $validade,
				'Status_recuperacao'		=> '0', //0 = não utilizado, 1 = utilizado
				'Data_recuperacao' 			=> $datarec
			];
		}else{
			$dados = [
				'ID_recuperacao '          => new RawSql('DEFAULT'),
				'ID_usuario '       		=> $id,
				'Codigo_recuperacao'        => $codigo,
				'Tipo_recuperacaote'        => $tipo,
				'Validade_recuperacao'		=> '',
				'Status_recuperacao'		=> '',
				'Data_recuperacao' => new RawSql('CURRENT_TIMESTAMP()'),
			];
		}
		
		
		$this->builder->insert($dados);



		//$this->builder->select('ID_clinica, Nome_fantasia_clinica');
        //$query = $this->builder->getWhere(['Email_clinica' => $login, 'Senha_clinica' => $senha], $limit, $offset)->getResultArray();
        //$this->db->close();
        //return $query;
	}	


