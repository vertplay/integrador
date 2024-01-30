<?php namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class ClinicaModel extends Model{
    protected $db, $builder;

    public function __construct(){

        $this->db= \Config\Database::connect();
        //aumentar tamanho limite de upload em caso de falha com imagem mais "pesada"
        //$maxp = $this->db->query( 'SELECT @@global.max_allowed_packet' );
        //$this->db->query( 'SET @@global.max_allowed_packet = ' . 500 * 1024 * 1024 );

        $this->builder = $this->db->table('clinica');
    }

    public function cadastrarClinica($parametros) : array{
        
        $erros = [];

        $query = 'INSERT INTO `clinica`(`Forma_pagamento_clinica`, `Email_clinica`, `Senha_clinica`, `Telefone_clinica`, `Whatsapp_clinica`, `Instagram_clinica`, `CNPJ`, `foto_clinica`, `tipo_de_imagem_clinica`,/* `Especialidade_clinica`*/, `Plano_saude_clinica`, `Convenio_clinica`, `Nome_fantasia_clinica`, `Logradouro`, `Bairro`, `Numero`, `Complemento`, `Descricao_clinica`,`Cep`)
         VALUES(:forma_pagamento:, :email:, :senha: , :telefone:, :whatsapp:, :instagram:, :cnpj:, :img:, :imgtype:,/*:especialidade: */, :plano_saude:, :convenio:, :nome:, :logradouro:, :bairro:, :numero:, :complemento:, :descricao:, :cep: );';
        
        $dados = $this->db->query($query, $parametros);
        
        if($dados){
            $erros[] = "sucesso";
        }
        else{
            $erros[] = "Falha";
        }
    
        $this->db->close();
        return $erros;
    
    }

    public function checkclinica($parametros) {
        $cnpj = $parametros['cnpj'];
        $email = $parametros['email'];
        
        $query = "SELECT * FROM clinica WHERE CNPJ = '$cnpj' OR Email_clinica = '$email'";
        $resultado = $this->db->query($query, $parametros);
        return $resultado->getNumRows() > 0;
    }

    public function login($login, $senha) : array{
        
        $limit=1;
        $offset=0;

        $this->builder->select('ID_clinica, Nome_fantasia_clinica');
        $query = $this->builder->getWhere(['Email_clinica' => $login, 'Senha_clinica' => $senha], $limit, $offset)->getResultArray();
        $this->db->close();
        return $query;
    }
    //obter dados da clinica pelo ID
    public function getClinica($id) : array{
        $this->builder->select('ID_clinica, Nome_fantasia_clinica, Forma_pagamento_clinica, Email_clinica, Telefone_clinica, Whatsapp_clinica, Instagram_clinica, Plano_saude_clinica, Descricao_clinica, Especialidade_clinica, Convenio_clinica, Cep, Logradouro, Bairro, Numero, Complemento');
        $query = $this->builder->getWhere(['ID_clinica' => $id])->getResultArray();
        $this->db->close();
        return $query;
	}
    //obter dados da clinica através do e-mail
    public function getClinicaByEmail($email){
        $this->builder->select('ID_clinica, Nome_fantasia_clinica');
        $query = $this->builder->getWhere(['Email_clinica' => $email])->getResultArray();
        $this->db->close();
        if($query!=null && $query!="")
            return $query[0];
        else
            return null;
    }
    public function atualizar_cadastro($id,$dados){
        $this->builder->where(['ID_clinica' => $id, 'Senha_clinica' => $dados['Senha_clinica']]);

        //if($query = $this->builder->get()->getResultArray() == null)
        //    return false;

        if($this->builder->update($dados)){
            return true;
        }
        else{
            return false;
        }
        
    }
    public function excluir_cadastro($id, $senha){
        $this->builder->where(['ID_clinica' => $id, 'Senha_clinica' => $senha]);
        if($this->builder->delete()){
            return true;
        }
        else{
            return false;
        }
    }
}