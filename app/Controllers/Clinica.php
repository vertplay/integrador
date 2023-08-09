<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClinicaModel;

class Clinica extends BaseController{

    public function __construct(){
        
    }
    
    public function index(){
        $session = session();
        if($session->has('id') && $session->get('id') != null && $session->get('tipo')=="clinica"){
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
        
    }
    public function registrar(){
        $login = $this->request->getPost('login');
        $senha = $this->request->getPost('senha');
        $nome = $this->request->getPost('nome');
        $img = $this->request->getFile('arquivo');
        
        
        if($login!="" && $senha!="" && !is_null($login) && !is_null($senha)){
            
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
    }
    public function logout(){
        $session = session();
        $array_items = ['id', 'nome', 'tipo'];
        $session->remove($array_items);
        return redirect()->to(base_url());
    }
}