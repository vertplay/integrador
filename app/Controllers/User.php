<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController{
    
    public function index(){
        $login = $this->request->getPost('login');
        $senha = $this->request->getPost('senha');
        
        
        
        if($login!="" && $senha!="" && !is_null($login) && !is_null($senha)){
            
            
        }
        else{
            return redirect()->to(base_url());
        }
        
    }

    public function registro(){
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

    public function processar_cadastro() {
        $this->load->model('User_model');

        $cpf = $this->input->post('cpf');
        $nome_completo = $this->input->post('nome_completo');

        $existing_data = $this->User_model->check_existing_data($cpf, $nome_completo);

        if (!empty($existing_data)) {
            $error_message = '';
            foreach ($existing_data as $row) {
                if ($row['CPF_usuario'] == $cpf) {
                    $error_message .= 'CPF já cadastrado. ';
                }
                if ($row['Nome_usuario'] == $nome_completo) {
                    $error_message .= 'Nome de Usuário já cadastrado.';
                }
            }

            $this->session->set_flashdata('error_message', $error_message);
            redirect('cliente/cadastrar');
        } else {
            $data = array(
                'CPF_usuario' => $cpf,
                'Nome_usuario' => $nome_completo,
                // Outros campos do formulário aqui...
            );

            $user_id = $this->User_model->insert_user($data);
            $this->session->set_flashdata('success_message', 'Usuário cadastrado com sucesso. ID: ' . $user_id);
            redirect('cliente/cadastrar');
        }
    }


}