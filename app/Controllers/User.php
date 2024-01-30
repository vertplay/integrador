<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Session\Session;

class User extends BaseController{
    protected $session;
    protected $userModel;

    public function __construct() {
        $this->session = \Config\Services::session();
        $this->userModel = new UserModel();
    }
    
    public function index(){
        if($this->session->has('ID_usuario') && $this->session->get('ID_usuario') != null && $this->session->get('tipo')=="pp"){

            $dados = $this->userModel->getUser($this->session->get('ID_usuario'));
            //dd($dados);
            return view('user/perfil',$dados);
        }
        else{
            return redirect()->to(base_url());
        }
    }
    
    public function checaSessao(){
        if($this->session->has('ID_clinica') || $this->session->has('ID_usuario')){
            return true;
        }
        else{
            return false;
        }
    }
    
    public function logout(){
        $session = session();
        $array_items = ['ID_usuario', 'Nome_usuario', 'tipo'];
        $session->remove($array_items);
        return redirect()->to(base_url());
    }


	public function registro(){
        if($this->checaSessao())//verifica se existe sessão, caso positivo volta para página inicial
            return redirect()->to(base_url());

		return view('user/registro');
	}
    public function erro(){
        return view('user/erro');
    }
    
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
        //$cpf = $this->request->getPost('cpf');
        $nome_usuario = $this->request->getPost('nome');
        $senha = $this->request->getPost('formsenha');
        //$img = $this->request->getFile('arquivo');
        //$rg = $this->request->getPost('rg');
        //$nome_completo = $this->request->getPost('nome');
        //$data_nascimento = $this->request->getPost('data_nascimento');
        //$genero = $this->request->getPost('genero');
        $email = $this->request->getPost('email');
        $whatsapp = $this->request->getPost('whatsapp');
        $telefone = $this ->request->getPost('telefone');
        $cep = $this->request->getPost('cep');
        $logradouro = $this->request->getPost('logradouro');
        $bairro = $this->request->getPost('bairro');
        $numero = $this->request->getPost('numero');
        $complemento = $this->request->getPost('complemento');

        $dados =array(
           //'cpf' => $cpf,
           'nome_usuario' => $nome_usuario,
           'senha' => $senha,
           //'img' => $img,
           //'rg' => $rg,
           //'nome_completo' => $nome_completo,
           //'data_nascimento' => $data_nascimento,
           //'genero' => $genero,
           'email' => $email,
           'whatsapp' => $whatsapp,
           'telefone' => $telefone,
           'cep' =>$cep,
           'logradouro' => $logradouro,
           'bairro' => $bairro,
           'numero' => $numero,
           'complemento' => $complemento
        );
        
        $parametros = array(
            //'cpf' =>$cpf,
            'email' =>$email
        );
        $senha = $dados['senha'];
        $consulta = new UserModel();
        $possui_usuario = $consulta->check_usuario($parametros);

        if (!$this->validarSenha($senha)) {
            $this->session->setFlashdata('error_message', 'A senha não atende aos requisitos de segurança.');
            echo view("user/erro");
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
                        window.location.href = "'.base_url().'/pp/registro";
                        }
                    }, 1000);
                </script>';
        return;
        }
        
        if ($possui_usuario) {
            $this->session->setFlashdata('error_message', 'O usuario já está cadastrado.');
            echo view('user/erro');
            echo '<div class="alert alert-danger">O usuario já está cadastrado. Você será redirecionado em breve...</div>';
            echo '<script>
                    var seconds = 5; // Tempo de espera em segundos
                    var message = document.querySelector(".alert-danger");
                    message.innerHTML += " Aguarde " + seconds + " segundos...";
                    setInterval(function() {
                        seconds--;
                        if (seconds > 0) {
                            message.innerHTML = "O usuario já está cadastrado. Aguarde " + seconds + " segundos...";
                        } else {
                         window.location.href = "'.base_url().'/pp/registro";
                     }
                }, 1000);
            </script>';
            return;    
        } else {
            $inserir = new UserModel();
            $resultado = $inserir->cadastrarUsuario($dados);
 
            $this->session->setFlashdata('success_message', 'O usuario foi cadastrado com sucesso.');
            echo view('clinicas/erro');
            echo '<div class="alert alert-success">O usuario foi cadastrado. Você será redirecionado em breve...</div>';
            echo '<script>
                    var seconds = 5; // Tempo de espera em segundos
                    var message = document.querySelector(".alert-success");
                    message.innerHTML += " Aguarde " + seconds + " segundos...";
                    setInterval(function() {
                        seconds--;
                        if (seconds > 0) {
                            message.innerHTML = "O usuario foi cadastrado. Aguarde " + seconds + " segundos...";
                        } else {
                         window.location.href = "'.base_url().'";
                     }
                }, 1000);
            </script>';
        }
    }
}