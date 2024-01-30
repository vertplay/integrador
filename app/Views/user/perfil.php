<?php $this->extend('layout')?>
		
	
    <?php $session = session();
        if(!$session->has('ID_clinica') && !$session->has('ID_usuario')){
            return redirect()->to(base_url()); // retorna ao inicio caso não exista sessão
        }
        if(true){
            $this->section('content');?>

            <!-----------------------javascript--------------------------------------->
			<script src="<?=base_url('js/perfil_btn.js')?>"></script>
			<script src="<?=base_url('js/mostrasenha.js')?>"></script>
			<script src="<?=base_url('js/mostrasenhadelete.js')?>"></script>
			<!-----------------------fim javascript--------------------------------------->
			

			<!--------------------------------------------formulario de exclusão-------------------------------------------->
			<div class="update-form formularios" style="display:none;" id="delete-form">
				<h2>Excluir Conta</h2>
				<h6></h6>
				<form id="deletePeForm" action="<?=base_url('pp/excluir')?>" method="POST" enctype="multipart/form-data">

					<label for="senha_clinica">Senha</label><br>
						<input type="password" name="formsenha" id="formsenha2" placeholder="Informe a senha" required>
						<button type="button" id="mostrar_senha2"><i class="material-icons">visibility</i></button> <br />

					<button type="submit" name="delete" id="deleteaccbtn">Excluir</button>
					<button type="button" id="cancelardelete_btn">Cancelar</button>
				</form>
			</div>
			<!--------------------------------------------------fim exclusão------------------------------------------->
			<div id="perfil-pag">
				<div id="clin-block1" class="clin-block">
					<div class="title"></div>
					<div class="info">
						<h3>Descrição:teste</h3>
					<p>&nbsp;</p>
					</div>
					<div id="album-block-img">
						
					</div>
					<div class="info">
						</br>
						<h3>Especialidades:</h3>
						<p></p>
					</div>
					<div class="info">
						</br>
						<h3>Endereço:</h3>
						<p>
						, Araçuaí - MG, 39600-000</p>
					</div>
					
					

				</div>

				<div id="clin-block2" class="clin-block">
					<button type="button" id="editperf_btn">Editar Dados</button>
					<form id="form-alterasenha" action="<?=base_url('/recuperacao')?>" method="POST" enctype="multipart/form-data">
					<input type="email" name="email" id="login" value="<?=$Email_usuario?>" style="display:none;"/>
						<button type="submit" id="editsenha_btn">Alterar Senha</button>
					</form>
					<button type="button" id="deleteperf_btn">Excluir Conta</button>	
				</div>
		</div>
        <?php $this->endSection();
				}elseif($session->has('ID_clinica') && $session->get('tipo') == "pe"){//caso usuário pessoa empresarial
            		return redirect()->to(base_url('pp/perfil'));?>
        
    <?php } ?>