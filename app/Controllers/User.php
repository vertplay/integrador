<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController{

    public function index(){
        $login = $this->request->getPost('login');
        $senha = $this->request->getPost('senha');
        $img = $this->request->getFile('arquivo');
        

        if($login!="" && $senha!="" && !is_null($login) && !is_null($senha)){
            $parametros = [
                'login' => $login,
                'senha' => $senha,
                'img' => base64_encode(file_get_contents($img)),
                'imgtype' => $img->getMimeType()
            ];
            if ( $img->isValid()){
                $inserir = new UserModel();
                $resultado = $inserir->novoUsuario($parametros);
                return redirect()->to(base_url());
            }
            else{
                echo "erro no arquivo<br><a href='".base_url()."'>Inicio</a>";

            }
            
            
        }
        else{
            return redirect()->to(base_url());
        }
        
    }
}