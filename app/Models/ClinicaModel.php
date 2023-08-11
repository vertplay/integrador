<?php namespace App\Models;

use CodeIgniter\Model;

class ClinicaModel extends Model{
    protected $db, $builder;

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('usuario');
    }


    public function login($login, $senha) : array{
        
        $limit=1;
        $offset=0;

        $this->builder->select('ID_usuario, Nome_usuario');
        $query = $this->builder->getWhere(['Email_usuario' => $login, 'Senha_usaurio' => $senha], $limit, $offset)->getResultArray();
        $this->db->close();
        return $query;
    }

    public function getClinica($id) : array{
		
        $this->builder->select('ID_usuario, Nome_usuario');
        $query = $this->builder->getWhere(['ID_usuario' => $id])->getResultArray();
        $this->db->close();
        return $query;
	}
}