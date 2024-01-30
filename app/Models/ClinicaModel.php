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

    public function get_Email(){
        $this->builder->select('Email_clinica');
        $query = $this->builder->getResultArray();
        return $query;
    }

    public function cadastrarClinica($parametros, $checkbox) : array{
        $erros = [];
        $query = 'INSERT INTO `endereco`(`Cidade`, `Estado`, `Numero`, `Rua`, `Complemento`, `CEP`, `Bairro`)
        VALUES(:cidade:, :estado:, :numero:, :logradouro:, :complemento:, :cep:, :bairro:);';
   
        $dados= $this->db->query($query, $parametros);

        $ultimoIdEndereco = $this->db->insertID();
        $parametros['id_endereco'] = $ultimoIdEndereco;
        
        $parametros['forma_pagamento'] = implode(',', $checkbox); // junta os dados do checkbox em uma string

        $query = 'INSERT INTO `clinica`(`ID_endereco`,`Forma_pagamento_clinica`, `Email_clinica`, `Senha_clinica`, `Telefone_clinica`, `Whatsapp_clinica`, `Instagram_clinica`, `CNPJ`, `foto_clinica`, `tipo_de_imagem_clinica`, `Plano_saude_clinica`, `Convenio_clinica`, `Nome_fantasia_clinica`,`Descricao_clinica`)
            VALUES(:id_endereco: ,:forma_pagamento:, :email:, :senha:, :telefone:, :whatsapp:, :instagram:, :cnpj:, :img:, :imgtype:, :plano_saude:, :convenio:, :nome:, :descricao:)';
           
        $dados = $this->db->query($query, $parametros);
        

       // $query = "INSERT INTO `clinica` (`ID_endereco`) VALUES ('$ultimoIdEndereco')";
        //$this->db->query($query);
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

        if($resultado->getNumRows() > 0){
            return $resultado->getNumRows() > 0;
        }
        else{
            $query = "SELECT * FROM usuario WHERE Email_usuario = '$email'";
            $resultado = $this->db->query($query, $parametros);
            if($resultado->getNumRows() > 0){
                //dd($resultado);
                return 1000;
            }
            //return $resultado->getNumRows() > 0;
        }
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
        $this->builder->select('ID_clinica, ID_endereco, Nome_fantasia_clinica, Forma_pagamento_clinica, Email_clinica, Telefone_clinica, Whatsapp_clinica, Instagram_clinica, Plano_saude_clinica, Descricao_clinica, Convenio_clinica');
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

    public function lista_medicos($id){
        $this->builder = $this->db->table('possui_vinculo');
        $ids = $this->builder->getWhere(['ID_clinica' => $id])->getResultArray();
        $this->builder = $this->db->table('medico');
        $lista = array();
        foreach($ids as $id_medico){
            $lista []= $this->builder->getWhere(['ID_medico' => $id_medico['ID_medico']])->getResultArray();
        }
        return $lista;
    }

    public function excluir_medico($id){
        $this->builder = $this->db->table('medico');
        $this->builder->where(['ID_medico' => $id]);
        if($this->builder->delete()){
            return true;
        }
        else{
            return false;
        }
    }

    public function cadastrar_medico($dados, $ID_clinica){
        $this->builder = $this->db->table('medico');
        if($this->builder->insert($dados)){
            //médico adicionado
            $ID_medico = $this->db->insertID();
            $dados_vinculo = array(
                'ID_medico' => $ID_medico,
                'ID_clinica' => $ID_clinica
            );

            $this->builder = $this->db->table('possui_vinculo');
            $this->builder->insert($dados_vinculo);
            return true;
        }
        else{
            return false;
        }
    }
}