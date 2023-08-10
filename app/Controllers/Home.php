<?php

namespace App\Controllers;

use App\Models\MainModel;

use App\Models\UserModel;

use App\Models\ClinicaModel;

use Config\Services\Email;

class Home extends BaseController
{
	//página inicial, listagem de clínicas
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
	public function recupera_senha(){
		$email = $this->request->getPost('email');
		if($email != null){
			echo 'sucesso';
			$mail = \Config\Services::email();
			$mail->setFrom('');
			$mail->setTO($email);
			/*$mail->setCC();
			$mail->setBCC();*/

			$mail->setSubject('teste');
			$mail->SetMessage('testando');
			$mail->send();
			
		}
		else{
			return view('recupera_senha');
		}
	}

	//Gera imagem
	public function img($id){
		$img = new MainModel();
		$imgdata = $img->pegaimg($id);
		$this->response->setContentType($imgdata['imgtype']);
		echo base64_decode($imgdata['img']);
	}
}
