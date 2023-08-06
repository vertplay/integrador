<?php namespace App\Models;

use CodeIgniter\Model;

class ClinicaModel extends Model{
    public function login($login, $senha){
        $db      = \Config\Database::connect();
        $builder = $db->table('usuarios');
        $limit=1;
        $offset=0;
        $builder->select('id, nome');
        $query = $builder->getWhere(['login' => $login, 'senha' => $senha], $limit, $offset)->getResultArray();
        return $query;
    }
}