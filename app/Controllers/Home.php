<?php

namespace App\Controllers;

use App\Models\MainModel;

use App\Models\UserModel;

class Home extends BaseController
{
	//página inicial, listagem de usuários que possuem músicas
	public function index()
	{
		$home = new MainModel();
		$enviar['dados'] = $home->list();
		return view('index', $enviar);
		
	}

	public function list(){
		
	}

	//página de usuario/perfil
	public function user($id){

		$user = new UserModel();
		$enviar["user"] = $user->getUser($id);
		$enviar["musicas"] = $user->getMusicas($id);


		if(empty($enviar["user"])){
			return view('errors/html/error_404');
		}

		$enviar["user"] = $enviar["user"][0];
		
		//print_r($enviar);
		
		return view('user',$enviar);
	}

	public function login(){
		return view('user/login');
	}

	//Gera imagem
	public function img($id){
		$img = new MainModel();
		$imgdata = $img->pegaimg($id);
		$this->response->setContentType($imgdata['imgtype']);
		echo base64_decode($imgdata['img']);
	}
}
