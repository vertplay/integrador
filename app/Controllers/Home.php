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
			date_default_timezone_set('America/Sao_Paulo');

			echo 'sucesso';
			$dadosclinica = new ClinicaModel();
			$dadosclinica = $dadosclinica->getClinicaByEmail($email);
			
			//echo time() .'<br>'.date('d/m/y - H:i:s',time());

			$timehelper=time();
			$tempodevalidade = 60*30; // 30 minutos
			$datarec = date('y-m-d H:i:s',$timehelper);
			
			$validade = date('y-m-d H:i:s',$timehelper + $tempodevalidade);
			
			$tiporec = 'pe';
			$codigo = hash('md5', $email.$timehelper);
			$mensagem = '<a href="'.base_url('/recuperacao?cod='.$codigo).'">Alterar senha</a>';

			$inserir = new MainModel();
			$resultado = $inserir->setCodeRecuperacao($dadosclinica['ID_clinica'], $codigo, $tiporec, $datarec, $validade);

			$mail = \Config\Services::email();
			$mail->setFrom('Araclin');
			$mail->setTO($email);
			/*$mail->setCC();
			$mail->setBCC();*/
			$mail->setSubject('Recuperação de senha');
			$mail->SetMessage($mensagem);

			
			

			$mail->send();
			
		}
		else{
			$codigo = $this->request->getGet('cod');
			if(!is_null($codigo) && $codigo != "" && strlen($codigo)==32){
				return view('form_trocar_senha',array($codigo));
			}
			else{
				return view('recupera_senha');
			}
			
		}
	}

	//Gera imagem
	public function img($id){
		$img = new MainModel();
		$imgdata = $img->pegaimg($id);
		$this->response->setContentType($imgdata['tipo_de_imagem_clinica']);
		echo base64_decode($imgdata['foto_clinica']);
	}
}
