<?php $this->extend('layout')?>
		
	
    <?php $session = session();
        if(!$session->has('ID_clinica') && !$session->has('ID_usuario')){
            return redirect()->to(base_url()); // retorna ao inicio caso não exista sessão
        }
        if($session->has('ID_clinica') && $session->get('Nome_fantasia_clinica') != null){//caso usuário clínica
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
				<form id= "userform" action="<?=base_url('pe/atualizar')?>" method="POST" enctype="multipart/form-data">
					<label for="nome_fantasia">Nome Fantasia</label><br>
						<input type="text" name="nome_fantasia" id="nome_fantasia" value="<?=$Nome_fantasia_clinica?>" required><br>
						<div class="error-message"></div>
					<label for="senha_clinica">Senha</label><br>
						<input type="password" name="formsenha" id="formsenha" placeholder="Obrigatório para alterar os dados" required>
						<button type="button" id="mostrar_senha"><i class="material-icons">visibility</i></button>
						
						<div id="alerta_senha"> </div>
						<input type="file" name="arquivo" ><br>
						<div class="error-message"></div>
					<!--Informações-->
					<label for="informacoes" class="sub_bloco-titulo">Info</label>
					<div class="sub_bloco" id="informacoes">

						<label for="forma_pagamento">Formas de pagamento</label>
							<label for="forma_pagamento_dinheiro" class="forma_pagamento">Dinheiro</label>
								<input type="checkbox" name="forma_pagamento_dinheiro" id="forma_pagamento_dinheiro" value="dinheiro">

							<label for="forma_pagamento_cartao" class="forma_pagamento">Cartão de crédito/débito</label>
								<input type="checkbox" name="forma_pagamento_cartao" id="forma_pagamento_cartao" value="cartao">
									
							<label for="forma_pagamento_pix" class="forma_pagamento">PIX</label>
								<input type="checkbox" name="forma_pagamento_pix" id="forma_pagamento_pix" value="pix">
								
							<label for="forma_pagamento_cheque" class="forma_pagamento">Cheque</label>
								<input type="checkbox" name="forma_pagamento_cheque" id="forma_pagamento_cheque" value="cheque">

							<label for="outro_campo" class="forma_pagamento" id="outras_formas_pagamento">Outras formas: </label><br>
								<input type="checkbox" name="forma_pagamento_outro" id="forma_pagamento_outro" value="outro">
								<input type="text" name="outro_campo" id="outro_campo">
						
						<label for="plano_saude_clinica">Planos de saúde aceitos</label>
							<input type="text" name="plano_saude_clinica" id="plano_saude_clinica" value="<?=$Plano_saude_clinica?>" required/>
							<div class="error-message"></div>
						<label for="convenio_clinica">Convenios</label>
							<input type="text" name="convenio_clinica" id="convenio_clinica" value="<?=$Convenio_clinica?>" required/>
							<div class="error-message"></div>
						<label for="descricao">Descrição</label>
							<textarea name="descricao" id="descricao" required><?=$Descricao_clinica?></textarea>
							<div class="error-message"></div>
					</div>
					<!--Endereço-->
					<label for="endereco" class="sub_bloco-titulo">Endereço</label>
					<div class="sub_bloco" id="endereco">
						<label for="cep">Cep</label>
							<input type="text" name="cep" id="cep" value="<?=$endereco["CEP"]?>" required/>
							<div class="error-message"></div>
						<label for="estado">Estado</label>
                        	<input type="text" name="estado" id="estado" value="<?=$endereco["Estado"]?>" required/>
                        	<div class="error-message"></div>
                    	<label for="cidade">Cidade</label>
                        	<input type="text" name="cidade" id="cidade" value="<?=$endereco["Cidade"]?>" required/>
                        	<div class="error-message"></div>
						<label for="logradouro">Logradouro</label>
							<input type="text" name="logradouro" id="logradouro" value="<?=$endereco["Rua"]?>" required/>
							<div class="error-message"></div>
						<label for="bairro">Bairro</label>
							<input type="text" name="bairro" id="bairro" value="<?=$endereco["Bairro"]?>" required/>
							<div class="error-message"></div>
						<label for="numero">Número</label>
							<input type="text" name="numero" id="numero" value="<?=$endereco["Numero"]?>" required/>
							<div class="error-message"></div>
						<label for="complemento">Complemento</label>
							<input type="text" name="complemento" id="complemento" value="<?=$endereco["Complemento"]?>"/>
					</div>
					<!--Contato-->
					<label for="contato">Contato</label> 
					<div class="sub_bloco" id="contato">
						<label for="email_clinica">E-mail</label>
							<input type="email" name="email_clinica" id="email_clinica" value="<?=$Email_clinica?>" required/>
							<div class="error-message"></div>
						<label for="telefone_clinica">Telefone</label>
							<input type="text" name="telefone_clinica" id="telefone_clinica" value="<?=$Telefone_clinica?>" required/>
							<div class="error-message"></div>
						<label for="whatsapp_clinica">Whatsapp</label>
							<input type="text" name="whatsapp_clinica" id="whatsapp_clinica" value="<?=$Whatsapp_clinica?>" />
						<label for="instagram_clinica">Instagram</label>
							<input type="text" name="instagram_clinica" id="instagram_clinica" placeholder="@" value="<?=$Instagram_clinica?>" />
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
				<form id="deletePeForm" action="<?=base_url('pe/excluir')?>" method="POST" enctype="multipart/form-data">

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
					<div class="title"><?= $Nome_fantasia_clinica ?></div>
					<div class="info">
						<h3>Descrição:</h3>
					<p>&nbsp;<?=$Descricao_clinica?></p>
					</div>
					<div id="album-block-img">
						<img src="<?= base_url('/img/'.$ID_clinica)?>"/>
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
						<?=$endereco["Rua"]?>, <?=$endereco["Numero"]?> - <?=$endereco["Bairro"]?>, <?=$endereco["Cidade"]?> - <?=$endereco["Estado"]?>, <?=$endereco["CEP"]?></p>
					</div>
					<div class="info">
						</br>
						<h3>Contato:</h3>
						<p>Telefone: <?=$Telefone_clinica?><br>
						WhatsApp: <?=$Whatsapp_clinica?><br>
						Intagram: @<?=$Instagram_clinica?><br>
						Email: <?=$Email_clinica?></p>
					</div>
					<div class="info">
						</br>
						<h3>Formas de Pagamento:</h3>
						<p><?= $Forma_pagamento_clinica ?></p>
					</div>
					<div class="info">
						</br>
						<h3>Convênios:</h3>
						<p><?= $Convenio_clinica ?></p>
					</div>

				</div>

				<div id="clin-block2" class="clin-block">
					<button type="button" id="editperf_btn">Editar Dados</button>
					<form id="form-alterasenha" action="<?=base_url('/recuperacao')?>" method="POST" enctype="multipart/form-data">
					<input type="email" name="email" id="login" value="<?=$Email_clinica?>" style="display:none;"/>
						<button type="submit" id="editsenha_btn">Alterar Senha</button>
					</form>
					<button type="button" id="deleteperf_btn">Excluir Conta</button>
					<a href="<?=base_url("/pe/gerenciar")?>"><buttom type="buttom"  id="gerenciar_med_btn">Gerenciar Médicos</buttom></a>
					
					
					<div class="info">
						<h3>Avaliações:</h3>
						<div id="comentarios">
							<h3>Avaliações:</h3>
							<?php if (!empty($avaliacoes)) : ?>
							<?php foreach ($avaliacoes as $avaliacao) : ?>
								<div class="comentarios">
									<p><strong><?= $avaliacao['Nome_usuario'] ?></strong></p>
									<p><?= str_repeat('&#9733;', $avaliacao['Nota_avaliacao']) ?></p>
									<p><?= $avaliacao['Texto_avaliacao'] ?></p>
								</div>
							<?php endforeach; ?>
						<?php else : ?>
							<p>A clínica ainda não possui nenhuma avaliação.</p>
						<?php endif; ?>

						</div>
					</div>
				</div>
		</div>
        <?php $this->endSection();
				}elseif($session->has('ID_usuario') && $session->get('tipo') == "pp"){//caso usuário pessoa física
            		return redirect()->to(base_url('pp/perfil'));?>
        
    <?php } ?>