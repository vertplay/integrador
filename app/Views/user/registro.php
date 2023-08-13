<?php $this->extend('layout')?>	
	<?=$this->section('content')?>
    <script src="<?=base_url("js/validarsenha.js") ?>"> </script>
        <div class="reg-form formularios">
            <h2>Registro</h2>
			<form id = "userform" action="<?=base_url('pp/registro')?>" method="POST" enctype="multipart/form-data">
                <label for="login">Usuário</label><br>
                    <input type="text" name="login" id="login" required><br>
                <label for="nome">Nome</label><br>
                    <input type="text" name="nome" id="nome" required><br>
                <label for="cpf">CPF</label><br>
                    <input type="text" name="cpf" id="cpf" required><br>
                <label for="rg">RG</label><br>
                    <input type="text" name="rg" id="rg" required><br>        
                <label for="senha">Senha</label><br>
                    <input type="password" name="senha" id="senha" required><br>
                    <input type="file" name="arquivo" required><br>

                <!--Informações-->    
                <label for="informacoes" class="sub_bloco-titulo">Info</label>
                <div class="sub_bloco" id="informacoes">
                    <label for="data_nascimento">Data de nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" required />
                   <label>Gênero</label>
                        <input type="radio" name="genero" id="genero_masculino" value="M" required>
                        <label for="genero_masculino">Masculino</label>
                        <input type="radio" name="genero" id="genero_feminino" value="F" required>
                        <label for="genero_feminino">Feminino</label><br>
                    <label for="email">Email</label>
                        <input type="email" name="email" id="email" required/>
                    <label for="whatsapp">Whatsapp</label>
                        <input type="text" name="whatsapp" id="whatsapp" required/>
                    <label for="telefone">Telefone</label>
                        <input type= "text" name="telefone" id="telefone" required>
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
                <button type="submit" name="registrar">Entrar</button>
	    	</form>
		</div>

    <?=$this->endSection()?>