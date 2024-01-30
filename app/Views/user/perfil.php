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
			<!--------------------------fomulario---------------------------------------->
			<div class="update-form formularios" style="display:none;" id="update-form">
				<h2>Alterar Dados</h2>
				<h6></h6>
                <form id= "userform" action="<?=base_url('pp/atualizar')?>" method="POST" enctype="multipart/form-data">

					<label for="nome_completo">Nome Completo</label><br>
						<input type="text" name="nome" id="nome" value="<?=$Nome_usuario?>" required><br>        
					<label for="senha">Senha</label><br>
						<input type="password" name="formsenha" id="formsenha" placeholder="Obrigatório para alterar os dados" required>
						<button type="button" id="mostrar_senha"><i class="material-icons">visibility</i></button>
						<div id="alerta_senha"> </div>
						

					<!--Informações-->    
					<label for="informacoes" class="sub_bloco-titulo">Info</label>
					<div class="sub_bloco" id="informacoes">
						<label for="email">Email</label>
							<input type="email" name="email" id="email" value="<?=$Email_usuario?>" required/>
						<label for="whatsapp">Whatsapp</label>
							<input type="number" name="whatsapp" id="whatsapp" pattern="[0-9]*" value="<?=$Whatsapp_usuario?>" required/>
						<label for="telefone">Telefone</label>
							<input type= "number" name="telefone" id="telefone" pattern="[0-9]*" value="<?=$Telefone_usuario?>" required>
					</div>

                    <button type="submit" name="salvar">Salvar</button>
					<button type="button" id="cancelarUpdate_btn">Cancelar</button>
				</form>
			</div>
			<!--------------------------------------------fim formulario---------------------------------------------------->

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
						<h3>Olá <?=$Nome_usuario ?></h3>
					<p>&nbsp; No momento não há funcionalidades agregadas ao perfil de usuário.</p>
					</div>
					<div class="info">
						<br/>
						<h3></h3>
						<p></p>
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