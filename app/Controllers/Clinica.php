<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClinicaModel;
//use CodeIgniter\Session\Session;

class Clinica extends BaseController{
    protected $session;
    protected $clinicaModel;

    public function __construct() {
        $this->session = \Config\Services::session();
        $this->clinicaModel = new ClinicaModel();
    }


    
    public function index(){
        $session = session();
        if($session->has('ID_clinica') && $session->get('ID_clinica') != null && $session->get('tipo')=="clinica"){
            $consulta = new ClinicaModel();
            return view('clinicas/perfil');
        }
        else{
            return redirect()->to(base_url());
        }
    }

    public function login(){
        return view('clinicas/login');
    }
    public function registro(){
        return view('clinicas/registro');
    }
    public function logar(){
        $login = $this->request->getPost('login');
        $senha = $this->request->getPost('senha');
        $consulta = new ClinicaModel();
        $dados = $consulta->login($login, $senha);
        if($dados != null){
            $session = session();
            $session->set($dados[0]);
            $session->set('tipo', 'clinica');
            return redirect()->to(base_url());
        }
        else{
            //return redirect()->to(base_url());
        }
        
    }
   /* public function registrar(){
        $email = $this->request->getPost('email');
        $login = $this->request->getPost('login');
        $senha = $this->request->getPost('senha');
        $nome = $this->request->getPost('nome');
        $img = $this->request->getFile('arquivo');
        
        
        if($login!="" && $senha!="" && !is_null($login) && !is_null($senha)){
            
            if ( $img->isValid()){
                
                
                $parametros = [
                    'email' => $email,
                    'login' => $login,
                    'senha' => $senha,
                    'nome' => $nome,
                    'img' => base64_encode(file_get_contents($img)),
                    'imgtype' => $img->getMimeType()
                ];

                $inserir = new ClinicaModel();
                $resultado = $inserir->cadastrarClinica($parametros);
                return redirect()->to(base_url());
            }
            else{
                echo "erro no arquivo<br><a href='".base_url()."'>Inicio</a>";

            }
        }
    }*/
    public function logout(){
        $session = session();
        $array_items = ['ID_clinica', 'Nome_fantasia_clinica', 'tipo'];
        $session->remove($array_items);
        return redirect()->to(base_url());
    }

    //Thiago parte
    public function processo_do_cadastro(){
        $cnpj = $this->request->getPost('cnpj');
        $nome_fantasia = $this->request->getPost('nome_fantasia');
        $senha = $this->request->getPost('senha_clinica');
        $img = $this->request->getFile('arquivo');
        $logradouro = $this->request->getPost('logradouro');
        $forma_pagamento = $this->request->getPost('forma_pagamento');
        $especialidade = $this->request->getPost('especialidade_clinica');
        $plano_saude = $this->request->getPost('plano_saude_clinica');
        $convenio = $this->request->getPost('convenio_clinica');
        $descricao = $this->request->getPost('descricao');
        $cep = $this ->request->getPost('cep');
        $bairro = $this->request->getPost('bairro');
        $numero = $this->request->getPost('numero');
        $complemento = $this->request->getPost('complemento');
        $email = $this->request->getPost('email_clinica');
        $telefone = $this->request->getPost('telefone_clinica');
        $whatsapp = $this->request->getPost('whatsapp_clinica');
        $instagram = $this->request->getPost('instagram_clinica');

        $dados =array(
            'cnpj' => $cnpj,
            'nome' => $nome_fantasia,
            'senha' => $senha,
            'img' => base64_encode(file_get_contents($img)),
            'imgtype' => $img->getMimeType(),
            'logradouro' => $logradouro,
            'forma_pagamento' => $forma_pagamento,
            'especialidade' => $especialidade,
            'plano_saude' => $plano_saude,
            'convenio' => $convenio,
            'descricao' => $descricao,
            'cep' => $cep,
            'bairro' => $bairro,
            'numero' => $numero,
            'complemento' => $complemento,
            'email' => $email,
            'telefone' => $telefone,
            'whatsapp' => $whatsapp,
            'instagram' => $instagram
        );

        $cnpj = $dados['cnpj'];
        $consulta = new ClinicaModel();
        $possui_clinica = $consulta->checkclinica($cnpj);
        
        if ($possui_clinica) {
            $this->session->set_flashdata('error_message', 'A clínica já está cadastrada.');
            return redirect()->to(base_url('/pe/registro'));
        } else {
            $inserir = new ClinicaModel();
            $resultado = $inserir->cadastrarClinica($dados);
            
            //$clinica_id = $this->clinicaModel->inserir_clinica($dados);
            //$this->session->set_flashdata('success_message', 'A clínica foi cadastrada com sucesso.');
            
            return redirect()->to(base_url()); 
        }
       
    }

       
}