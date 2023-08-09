<?php

namespace App\Controllers;

use App\Models\MainModel;

use App\Models\UserModel;

use App\Models\ClinicaModel;

class Home extends BaseController
{
	//página inicial, listagem de usuários que possuem músicas
	public function index()
	{
		$home = new MainModel();
		$enviar['dados'] = $home->list();
		return view('index', $enviar);
		
	}


	//página de usuario/perfil
	public function clinica($id){

		$clin = new ClinicaModel();
		$enviar["clin"] = $clin->getClinica($id);


		if(empty($enviar["clin"])){
			return view('errors/html/error_404');
		}

		$enviar["clin"] = $enviar["clin"][0];
		
		//print_r($enviar);
		
		return view('clinica',$enviar);
	}

	public function login(){
		return view('user/login');
	}
	public function registro(){
		return view('user/registro');
	}

	//Gera imagem
	public function img($id){
		$img = new MainModel();
		$imgdata = $img->pegaimg($id);
		$this->response->setContentType($imgdata['imgtype']);
		echo base64_decode($imgdata['img']);
	}
}
