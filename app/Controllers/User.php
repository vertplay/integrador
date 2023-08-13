<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Session\Session;

class User extends BaseController{
    protected $session;
    protected $UserModel;

    public function __construct() {
        $this->session = \Config\Services::session();
    }

    public function index(){
        $login = $this->request->getPost('login');
        $senha = $this->request->getPost('senha');
        
        
        if($login!="" && $senha!="" && !is_null($login) && !is_null($senha)){
            
            
        }
        else{
            return redirect()->to(base_url());
        }
        
    }

    public function erro(){
        return view('user/erro');
    }    

    public function processo_do_cadastro(){
        $cpf = $this->request->getPost('cpf');
        $nome_usuario = $this->request->getPost('login');
        $senha = $this->request->getPost('formsenha');
        $img = $this->request->getFile('arquivo');
        $rg = $this->request->getPost('rg');
        $nome_completo = $this->request->getPost('nome');
        $data_nascimento = $this->request->getPost('data_nascimento');
        $genero = $this->request->getPost('genero');
        $email = $this->request->getPost('email');
        $whatsapp = $this->request->getPost('whatsapp');
        $telefone = $this ->request->getPost('telefone');
        $cep = $this->request->getPost('cep');
        $logradouro = $this->request->getPost('logradouro');
        $bairro = $this->request->getPost('bairro');
        $numero = $this->request->getPost('numero');
        $complemento = $this->request->getPost('complemento');

        $dados =array(
           'cpf' => $cpf,
           'nome_usuario' => $nome_usuario,
           'senha' => $senha,
           'img' => $img,
           'rg' => $rg,
           'nome_completo' => $nome_completo,
           'data_nascimento' => $data_nascimento,
           'genero' => $genero,
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
            'cpf' =>$cpf,
            'email' =>$email
        );
        
        $consulta = new UserModel();
        $possui_usuario = $consulta->check_usuario($parametros);

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

        /*if($login!="" && $senha!="" && !is_null($login) && !is_null($senha)){
            
            if ( $img->isValid()){
                
                
                $parametros = [
                    'login' => $login,
                    'senha' => $senha,
                    'nome' => $nome,
                    'img' => base64_encode(file_get_contents($img)),
                    'imgtype' => $img->getMimeType()
                ];

                $inserir = new UserModel();
                $resultado = $inserir->novoUsuario($parametros);
                return redirect()->to(base_url());
            }
            else{
                echo "erro no arquivo<br><a href='".base_url()."'>Inicio</a>";

            }
        }
    }*/


}
}