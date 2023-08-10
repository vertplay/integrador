<?php namespace App\Models;

use CodeIgniter\Model;

class ClinicaModel extends Model{
    protected $db, $builder;

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('usuarios');
    }


    public function login($login, $senha) : array{
        
        $limit=1;
        $offset=0;

        $this->builder->select('id, nome');
        $query = $this->builder->getWhere(['login' => $login, 'senha' => $senha], $limit, $offset)->getResultArray();
        $this->db->close();
        return $query;
    }

    public function getClinica($id) : array{
		
        $this->builder->select('id, nome');
        $query = $this->builder->getWhere(['id' => $id])->getResultArray();
        $this->db->close();
        return $query;
	}
}