<?php namespace App\Models;

use CodeIgniter\Model;

class ClinicaModel extends Model{
    protected $db, $builder;

    public function __construct(){
        


        $this->db      = \Config\Database::connect();
        //aumentar tamanho limite de upload em caso de falha com imagem mais "pesada"
        //$maxp = $this->db->query( 'SELECT @@global.max_allowed_packet' );
        //$this->db->query( 'SET @@global.max_allowed_packet = ' . 500 * 1024 * 1024 );

        $this->builder = $this->db->table('clinica');
    }

    public function cadastrarClinica($parametros) : array{
        
        $erros = [];
    
        $dados = $this->db->query('
            INSERT INTO clinica
            (Email_clinica, Senha_clinica, Nome_fantasia_clinica, foto_clinica, tipo_de_imagem_clinica)
            VALUES(:email:, :senha:, :nome:, ":img:", :imgtype:)
            ', $parametros);
        if($dados){
            $erros[] .= "sucesso";
        }
        else{
            $erros[] .= "Falha";
        }
        $this->db->close();
        
        return $erros;
    }

    public function login($login, $senha) : array{
        
        $limit=1;
        $offset=0;

        $this->builder->select('ID_clinica, Nome_fantasia_clinica');
        $query = $this->builder->getWhere(['Email_clinica' => $login, 'Senha_clinica' => $senha], $limit, $offset)->getResultArray();
        $this->db->close();
        return $query;
    }

    public function getClinica($id) : array{
		
        $this->builder->select('ID_clinica, Nome_fantasia_clinica');
        $query = $this->builder->getWhere(['ID_clinica' => $id])->getResultArray();
        $this->db->close();
        return $query;
	}
    public function getClinicaByEmail($email){
        $this->builder->select('ID_clinica, Nome_fantasia_clinica');
        $query = $this->builder->getWhere(['Email_clinica' => $email])->getResultArray();
        $this->db->close();
        return $query[0];
    }
}