<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClinicaModel;
use CodeIgniter\Session\Session;

class Clinica extends BaseController{
    protected $session;
    protected $clinicaModel;

    public function __construct() {
        $this->session = \Config\Services::session();
        $this->clinicaModel = new ClinicaModel();
    }

    public function checaSessao(){
        if($this->session->has('ID_clinica') || $this->session->has('ID_usuario')){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function index(){
        if($this->session->has('ID_clinica') && $this->session->get('ID_clinica') != null && $this->session->get('tipo')=="pe"){

            return view('clinicas/perfil');
        }
        else{
            return redirect()->to(base_url());
        }
    }

    public function login(){
        if($this->checaSessao())//verifica se existe sessão, caso positivo volta para página inicial
            return redirect()->to(base_url());

        return view('clinicas/login');
    }
    public function registro(){
        if($this->checaSessao())//verifica se existe sessão, caso positivo volta para página inicial
            return redirect()->to(base_url());

        return view('clinicas/registro');
    }

    public function erro(){
        return view('clinicas/erro');
    }

    public function logar(){
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');
        
        $dados = $this->clinicaModel->login($email, $senha);
        if($dados != null){
            $session = session();
            $session->set($dados[0]);
            $session->set('tipo', 'pe');
            return redirect()->to(base_url());
        }
        else{
            $this->session->setFlashdata('error_message', 'Cadastro não encontrado no sistema, favor verificar os dados informados.');
            echo view("clinicas/erro");
            echo '<script>
                    var seconds = 5; // Tempo de espera em segundos
                    var message = document.querySelector(".alert-danger");
                    message.innerHTML += " Aguarde " + seconds + " segundos...";
                    setInterval(function() {
                        seconds--;
                    if (seconds > 0) {
                        message.innerHTML = "Cadastro não encontrado no sistema, favor verificar os dados informados. Aguarde " + seconds + " segundos...";
                    } else {
                        window.location.href = "'.base_url('pe/login').'";
                        }
                    }, 1000);
                </script>';
        }
        
    }
   
    public function logout(){
        $session = session();
        $array_items = ['ID_clinica', 'Nome_fantasia_clinica', 'tipo'];
        $session->remove($array_items);
        return redirect()->to(base_url());
    }


    //Thiago parte
    public function validarSenha($senha) {
        $temNumero = preg_match('/[0-9]/', $senha);
        $temLetraMaiuscula = preg_match('/[A-Z]/', $senha);
        $temLetraMinuscula = preg_match('/[a-z]/', $senha);
        $temCaractereEspecial = preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\/]/', $senha);
    
        if ($temNumero && $temLetraMaiuscula && $temLetraMinuscula && $temCaractereEspecial) {
            return true; // A senha atende aos requisitos de validação
        } else {
            return false; // A senha não atende aos requisitos de validação
        }
    }

    public function processo_do_cadastro(){
        $cnpj = $this->request->getPost('cnpj');
        $nome_fantasia = $this->request->getPost('nome_fantasia');
        $senha = $this->request->getPost('formsenha');
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
        
        $parametros = array(
            'cnpj' =>$cnpj,
            'email' =>$email
        );

        $senha = $dados['senha'];
        $consulta = new ClinicaModel();
        $possui_clinica = $consulta->checkclinica($parametros);
        
        if (!$this->validarSenha($senha)) {
            $this->session->setFlashdata('error_message', 'A senha não atende aos requisitos de segurança.');
            echo view("clinicas/erro");
            echo '<div class="alert alert-danger">A senha não atende os requesitos de segurança. Você será redirecionado em breve...</div>';
            echo '<script>
                    var seconds = 5; // Tempo de espera em segundos
                    var message = document.querySelector(".alert-danger");
                    message.innerHTML += " Aguarde " + seconds + " segundos...";
                    setInterval(function() {
                        seconds--;
                    if (seconds > 0) {
                        message.innerHTML = "A senha não atende os requesitos de segurança. Aguarde " + seconds + " segundos...";
                    } else {
                        window.location.href = "'.base_url().'/pe/registro";
                        }
                    }, 1000);
                </script>';
        return;
        }
    

        if ($possui_clinica) {
            $this->session->setFlashdata('error_message', 'A clínica já está cadastrada.');
            echo view('clinicas/erro');
            echo '<div class="alert alert-danger">A clínica já está cadastrada. Você será redirecionado em breve...</div>';
            echo '<script>
                    var seconds = 5; // Tempo de espera em segundos
                    var message = document.querySelector(".alert-danger");
                    message.innerHTML += " Aguarde " + seconds + " segundos...";
                    setInterval(function() {
                        seconds--;
                        if (seconds > 0) {
                            message.innerHTML = "A clínica já está cadastrada. Aguarde " + seconds + " segundos...";
                        } else {
                         window.location.href = "'.base_url().'/pe/registro";
                        }
                    }, 1000);
                </script>';
            return;    
        } else {
            $inserir = new ClinicaModel();
            $resultado = $inserir->cadastrarClinica($dados);
 
            $this->session->setFlashdata('success_message', 'A clínica foi cadastrada com sucesso.');
            echo view('clinicas/erro');
            echo '<div class="alert alert-success">A clínica foi cadastrada. Você será redirecionado em breve...</div>';
            echo '<script>
                    var seconds = 5; // Tempo de espera em segundos
                    var message = document.querySelector(".alert-success");
                    message.innerHTML += " Aguarde " + seconds + " segundos...";
                    setInterval(function() {
                        seconds--;
                        if (seconds > 0) {
                            message.innerHTML = "A clínica foi cadastrada. Aguarde " + seconds + " segundos...";
                        } else {
                         window.location.href = "'.base_url().'";
                     }
                }, 1000);
            </script>';
        }
       
    }

       
}