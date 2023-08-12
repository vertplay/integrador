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
    public function registrar(){
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
    }
    public function logout(){
        $session = session();
        $array_items = ['ID_clinica', 'Nome_fantasia_clinica', 'tipo'];
        $session->remove($array_items);
        return redirect()->to(base_url());
    }

    public function processo_do_cadastro() {
        $this->load->model('Clinica_model');

        $dados = array(
            'CNPJ' => $this->input->post('cnpj'),
            'Nome_fantasia_clinica' => $this->input->post('nome_fantasia'),
            'foto_clinica' => '', // vert aqui
            'Descricao_clinica' => $this->input->post('descricao'),
            'Logradouro' => $this->input->post('logradouro'),
            'Numero' => $this->input->post('numero'),
            'Complemento' => $this->input->post('complemento'),
            'Bairro' => $this->input->post('bairro'),
            'CEP' => $this->input->post('cep'),
            'Forma_pagamento_clinica' => $this->input->post('forma_pagamento'),
            'Email_clinica' => $this->input->post('email_clinica'),
            'Senha_clinica' => $this->input->post('senha_clinica'),
            'Telefone_clinica' => $this->input->post('telefone_clinica'),
            'Whatsapp_clinica' => $this->input->post('whatsapp_clinica'),
            'Instagram_clinica' => $this->input->post('instagram_clinica'),
            'Especialidade_clinica' => $this->input->post('especialidade_clinica'),
            'Plano_saude_clinica' => $this->input->post('plano_saude_clinica'),
            'Convenio_clinica' => $this->input->post('convenio_clinica')
        );

        $cnpj = $dados['CNPJ'];

        if ($this->Clinica_model->checkclinica($cnpj)) {
            $this->session->set_flashdata('error_message', 'A clínica já está cadastrada.');
            redirect('clinica/cadastrar');
        } else {
            $clinica_id = $this->Clinica_model->inserir_clinica($dados);
            $this->session->set_flashdata('success_message', 'A clínica foi cadastrada com sucesso.');
            redirect('clinica/cadastrar'); 
        }
    }
}