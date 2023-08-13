<?php $this->extend('layout')?>
	
	<?=$this->section('content')?>
        <script src="<?=base_url('js/validarsenha.js')?>"></script>
        <script src="<?=base_url('js/mostrasenha.js')?>"></script>
        <div class="reg-form formularios">
            <h2>Registro</h2>
			<form id= "userform" action="<?=base_url('pe/registro')?>" method="POST" enctype="multipart/form-data">
                <label for="cnpj">CNPJ</label><br>
                    <input type="text" name="cnpj" id="cnpj" required><br>
                    <div class="error-message"></div>
                <label for="nome_fantasia">Nome Fantasia</label><br>
                    <input type="text" name="nome_fantasia" id="nome_fantasia" required><br>
                    <div class="error-message"></div>
                <label for="senha_clinica">Senha</label><br>
                    <input type="password" name="formsenha" id="formsenha" required>
                    <button type="button" id="mostrar_senha"><i class="material-icons">visibility</i></button>
                    <div id="alerta_senha"> </div>
                    <input type="file" name="arquivo" required><br>
                    <div class="error-message"></div>
                <!--Informações-->
                <label for="informacoes" class="sub_bloco-titulo">Info</label>
                <div class="sub_bloco" id="informacoes">
                    <label for="forma_pagamento">Formas de pagamento</label>
                        <input type="text" name="forma_pagamento" id="forma_pagamento" required />
                        <div class="error-message"></div>
                    <label for="especialidade_clinica">Especialidades médicas</label>
                        <input type="text" name="especialidade_clinica" id="especialidade_clinica" required/>
                        <div class="error-message"></div>
                    <label for="plano_saude_clinica">Planos de saúde aceitos</label>
                        <input type="text" name="plano_saude_clinica" id="plano_saude_clinica" required/>
                        <div class="error-message"></div>
                    <label for="convenio_clinica">Convenios</label>
                        <input type="text" name="convenio_clinica" id="convenio_clinica" required/>
                        <div class="error-message"></div>

                    <label for="descricao">Descrição</label>
                        <textarea name="descricao" id="descricao" required></textarea>
                        <div class="error-message"></div>
                </div>
                <!--Endereço-->
                <label for="endereco" class="sub_bloco-titulo">Endereço</label>
                <div class="sub_bloco" id="endereco">
                    <label for="cep">Cep</label>
                        <input type="text" name="cep" id="cep" required/>
                        <div class="error-message"></div>
                    <label for="logradouro">Logradouro</label>
                        <input type="text" name="logradouro" id="logradouro" required/>
                        <div class="error-message"></div>
                    <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" id="bairro" required/>
                        <div class="error-message"></div>
                    <label for="numero">Número</label>
                        <input type="text" name="numero" id="numero" required/>
                        <div class="error-message"></div>
                    <label for="complemento">Complemento</label>
                        <input type="text" name="complemento" id="complemento"/>
                </div>
                <!--Contato-->
                <label for="contato">Contato</label> 
                <div class="sub_bloco" id="contato">
                    <label for="email_clinica">E-mail</label>
                        <input type="email" name="email_clinica" id="email_clinica" required/>
                        <div class="error-message"></div>
                    <label for="telefone_clinica">Telefone</label>
                        <input type="text" name="telefone_clinica" id="telefone_clinica" required/>
                        <div class="error-message"></div>
                    <label for="whatsapp_clinica">Whatsapp</label>
                        <input type="text" name="whatsapp_clinica" id="whatsapp_clinica"/>
                    <label for="instagram_clinica">Instagram</label>
                        <input type="text" name="instagram_clinica" id="instagram_clinica" placeholder="@"/>
                </div>

                <button type="submit" name="registrar">Cadastrar</button>
	    	</form>
		</div>
    



    <?=$this->endSection()?>