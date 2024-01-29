<?php

namespace App\Controllers;

use App\Models\MainModel;

use App\Models\UserModel;

use App\Models\ClinicaModel;

use App\Models\AvaliacaoModel;

use Config\Services\Email;

use CodeIgniter\Session\SessionInterface; 


class Home extends BaseController
{

	protected $session;

	public function __construct() {

        $this->session = \Config\Services::session(); // Inicializa a sessão no construtor
    }

	//página inicial, listagem de clínicas
	public function index(){

		$home = new MainModel();
		$enviar['dados'] = $home->list();
		return view('index', $enviar);	
	}

	//Gera imagem
	public function img($id) {

		$img = new MainModel();
		$imgdata = $img->pegaimg($id);
		$this->response->setContentType($imgdata['tipo_de_imagem_clinica']);
		echo base64_decode($imgdata['foto_clinica']);
	}
	//Verificar se existe sessão
	public function checaSessao(){
        if($this->session->has('ID_clinica') || $this->session->has('ID_usuario')){
            return true;
        }
        else{
            return false;
        }
    }
	//Formulário de login
    public function login(){
        if($this->checaSessao())//verifica se existe sessão, caso positivo volta para página inicial
            return redirect()->to(base_url());
            
		return view('/login');
	}

	//Realizar login
	public function logar(){
		$clinicaModel = new ClinicaModel();
		$userModel = new UserModel();

        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');
        
        $dados = $clinicaModel->login($email, $senha);
        if($dados != null){
            $session = session();
            $session->set($dados[0]);
            $session->set('tipo', 'pe');
            return redirect()->to(base_url());
        }
		else{
			$dados = $userModel->login($email, $senha);
			if($dados != null){
				$session = session();
				$session->set($dados[0]);
				$session->set('tipo', 'pp');
				return redirect()->to(base_url());
			}
			else{
				$this->session->setFlashdata('error_message', 'Cadastro não encontrado no sistema, favor verificar os dados informados.');
				echo view("clinicas/erro");
				echo '<script>
						var seconds = 5; // Tempo de espera em segundos
						var message = document.querySelector(".alert-danger");
						message.innerHTML += " Aguarde " + seconds + " segundos...";
						setInterval(function() {
							seconds--;
						if (seconds > 0) {
							message.innerHTML = "Cadastro não encontrado no sistema, favor verificar os dados informados. Aguarde " + seconds + " segundos...";
						} else {
							window.location.href = "'.base_url('/login').'";
							}
						}, 1000);
					</script>';
			}
		}
    }

	//página de usuario/perfil
	public function clinica($id){

		$clin = new ClinicaModel();
		$enviar["clin"] = $clin->getClinica($id);

		if(empty($enviar["clin"])){
			return view('errors/html/error_404');
		}

		$avaliacaoModel = new AvaliacaoModel();
		$enviar['avaliacoes'] = $avaliacaoModel->getComentariosPorClinica($id);

		$enviar["clin"] = $enviar["clin"][0];
		

		$this->session->set('avaliacao_clinica_id', $id);

        if ($this->session->has('ID_usuario')) {
            $ID_usuario = $this->session->get('ID_usuario');
            $enviar["ID_usuario"] = $ID_usuario;
        } 
		else {
            $enviar["ID_usuario"] = null;
        }

		return view('clinica',$enviar);
	}

	public function enviarAvaliacao() {
		$avaliacaoModel = new AvaliacaoModel();
	
		$ID_usuario = $this->session->get('ID_usuario');
		$ID_clinica = $this->request->getPost('ID_clinica');
		$comentario = $this->request->getPost('comentario');
		$nota_avaliacao = $this->request->getPost('nota_avaliacao');
	
		if ($this->session->has('ID_usuario')) {
			$data = [
				'ID_usuario' => $ID_usuario,
				'ID_clinica' => $ID_clinica,
				'Texto_avaliacao' => $comentario,
				'Nota_avaliacao' => $nota_avaliacao, 
			];
	
			$avaliacaoModel->inserirAvaliacao($data);
			return redirect()->to('/clinica/' . $ID_clinica);
		}
	}
	
	public function recupera_senha(){
		$email = $this->request->getPost('email');
		if($email != null || $email != ""){
			date_default_timezone_set('America/Sao_Paulo');

			$dadosclinica = new ClinicaModel();
			$dadosclinica = $dadosclinica->getClinicaByEmail($email);
			$dadosuser = new UserModel();
			$dadosuser = $dadosuser->getUserByEmail($email);
			$dados;
			$tipo;
			if($dadosclinica == null && $dadosuser == null){//email não cadastrado
				return view('recuperacao/aviso_nao_enviado');
			}
			else{
				if($dadosuser != null){
					$dados = $dadosuser;
					$tipo = "pp";
				}
				else{
					$dados = $dadosclinica;
					$tipo = "pe";
				}
			}
			
			//echo time() .'<br>'.date('d/m/y - H:i:s',time());

			$timehelper=time();
			$tempodevalidade = 60*30; // 30 minutos
			$datarec = date('y-m-d H:i:s',$timehelper);
			
			$validade = date('y-m-d H:i:s',$timehelper + $tempodevalidade);
			
			$codigo = hash('md5', $email.$timehelper);
			$mensagem = '<a href="'.base_url('/recuperacao?cod='.$codigo).'">Alterar senha</a>';

			$inserir = new MainModel();
			if($tipo == "pp"){
				$resultado = $inserir->setCodeRecuperacao($dados['ID_usuario'], $codigo, $tipo, $datarec, $validade);
			}
			else{
				$resultado = $inserir->setCodeRecuperacao($dados['ID_clinica'], $codigo, $tipo, $datarec, $validade);
			}
			

			$mail = \Config\Services::email();
			$mail->setFrom('mailer.codeigniter@gmail.com','Araclin');
			$mail->setTO($email);
			echo $mail->printDebugger();
			/*$mail->setCC();
			$mail->setBCC();*/
			$mail->setSubject('Recuperação/Alteração de senha');
			$mail->SetMessage($mensagem);

			if($mail->send()){
				return view('recuperacao/aviso_enviado');
			}else{//falha no envio de email
				return view('recuperacao/aviso_nao_enviado');
			}
	
		}
		else{
			$codigo = $this->request->getGet('cod');
			if(!is_null($codigo) && $codigo != "" && strlen($codigo)==32){
				$codigo = [ 'codigo' => $codigo];
				return view('form_trocar_senha',$codigo);
			}
			else{
				return view('recupera_senha');
			}		
		}
	}

	public function realizar_alteracao_de_senha(){
		$codigo = $this->request->getPost('Enviar');
		$senha = $this->request->getPost('senha');
		$confirmSenha = $this->request->getPost('confirmsenha');

		$home = new MainModel();
		if($senha === $confirmSenha){
			$link = $home->redefine_senha($senha, $codigo);
			return redirect()->to(base_url("$link/login"));
		}
	}
}


