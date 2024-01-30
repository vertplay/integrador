<?php namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model{
	protected $db, $builder;

	public function __construct(){
		$this->db = \Config\Database::connect();
	}

	public function list() : array {
		$dados = $this->db->query("
			SELECT c.ID_clinica, c.Nome_fantasia_clinica, AVG(a.Nota_avaliacao) AS Media_Avaliacao
			FROM clinica c
			LEFT JOIN avalia_avaliacao a ON c.ID_clinica = a.ID_clinica
			GROUP BY c.ID_clinica, c.Nome_fantasia_clinica
			ORDER BY Media_Avaliacao DESC
		")->getResultArray();
		$this->db->close();
		return $dados;
	}
	
	public function pegaimg($id) : array {
		$db = \Config\Database::connect();
		$dados = $this->db->query("
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
		$dados = $this->db->query("
			SELECT c.ID_clinica, c.Nome_fantasia_clinica, AVG(a.Nota_avaliacao) AS Media_Avaliacao
			FROM clinica c
			LEFT JOIN avalia_avaliacao a ON c.ID_clinica = a.ID_clinica
			LEFT JOIN possui_vinculo pv ON c.ID_clinica = pv.ID_clinica
			LEFT JOIN medico m ON pv.ID_medico = m.ID_medico
			WHERE c.Nome_fantasia_clinica LIKE '%$termo%'
			   OR c.Especialidade_clinica LIKE '%$termo%'
			   OR m.Nome_medico LIKE '%$termo%'
			GROUP BY c.ID_clinica, c.Nome_fantasia_clinica
			ORDER BY Media_Avaliacao DESC
		")->getResultArray();
		$db->close();
		return $dados;
	}

	public function setCodeRecuperacao($id, $codigo, $tipo, $datarec, $validade){
		$dados;
		if($tipo == 'pe'){
			$dados = [
				'ID_clinica '       		=> $id,
				'Codigo_recuperacao'        => $codigo,
				'Tipo_recuperacao'        	=> $tipo,
				'Validade_recuperacao'		=> $validade,
				'Status_recuperacao'		=> '0', //0 = não utilizado, 1 = utilizado
				'Data_recuperacao' 			=> $datarec
			];
		}else{
			$dados = [
				'ID_usuario '       		=> $id,
				'Codigo_recuperacao'        => $codigo,
				'Tipo_recuperacao'        => $tipo,
				'Validade_recuperacao'		=> $validade,
				'Status_recuperacao'		=> '0',
				'Data_recuperacao' 			=> $datarec
			];
		}
		$this->builder = $this->db->table('recuperacao');
		
		$this->builder->insert($dados);

		//$this->builder->select('ID_clinica, Nome_fantasia_clinica');
        //$query = $this->builder->getWhere(['Email_clinica' => $login, 'Senha_clinica' => $senha], $limit, $offset)->getResultArray();
        //$this->db->close();
        //return $query;
	}
	public function getIdByRecuperacao($codigo){
		$this->builder = $this->db->table('recuperacao');
		$this->builder->select('ID_clinica, ID_usuario');
		$id = $this->builder->getWhere(['Codigo_recuperacao' => $codigo])->getResultArray();
		$id = $id[0];
		$dados;
		if($id['ID_clinica'] != null){
			$dados = [
				'id' => $id['ID_clinica'],
				'tipo' => 'clinica'
			];
		}
		else{
			$dados = [
				'id' => $id['ID_usuario'],
				'tipo' => 'usuario'
			];
		}
		return $dados;
	}
	public function redefine_senha($senha, $codigo){
		$dados = $this->getIdByRecuperacao($codigo);
		$retorno;
		if($dados['tipo'] == 'clinica'){
			$this->builder = $this->db->table('clinica');
			$this->builder->set(['Senha_clinica' => $senha]);
			$this->builder->where('ID_clinica', $dados['id']);
			$this->builder->update();
			$retorno = "pe";
		}
		else{
			$this->builder = $this->db->table('usuario');
			$this->builder->set(['Senha_usuario' => $senha]);
			$this->builder->where('ID_usuario', $dados['id']);
			$this->builder->update();
			$retorno = "pp";
		}
		$this->builder = $this->db->table('recuperacao');
		$this->builder->set(['Status_recuperacao' => '1']);
		$this->builder->where('Codigo_recuperacao', $codigo);
		$this->builder->update();
		return $retorno;
	}

	public function getEndereco($id){
		$this->builder = $this->db->table('endereco');
		$this->builder->select('ID_endereco, Cidade, Estado, Numero, Rua, Complemento, CEP, Bairro');
		$dados = $this->builder->getWhere(['ID_endereco' => $id])->getResultArray();
		return $dados[0];
	}
}