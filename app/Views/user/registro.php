<?php $this->extend('layout')?>	
	<?=$this->section('content')?>
        <script src="<?=base_url('js/validarsenha.js')?>"></script>
        <script src="<?=base_url('js/mostrasenha.js')?>"></script>
        <div class="reg-form formularios">
            <h2>Registro</h2>
			<form id = "userform" action="<?=base_url('pp/registro')?>" method="POST" enctype="multipart/form-data">
                <label for="nome_completo">Nome Completo</label><br>
                    <input type="text" name="nome" id="nome" required><br>
                <label for="cpf">CPF</label><br>
                    <input type="text" name="cpf" id="cpf" required><br>
                <label for="rg">RG</label><br>
                    <input type="text" name="rg" id="rg" required><br>        
                <label for="senha">Senha</label><br>
                    <input type="password" name="formsenha" id="formsenha" required>
                    <button type="button" id="mostrar_senha"><i class="material-icons">visibility</i></button>
                    <div id="alerta_senha"> </div>
                    

                <!--Informações-->    
                <label for="informacoes" class="sub_bloco-titulo">Info</label>
                <div class="sub_bloco" id="informacoes">
                    <label for="data_nascimento">Data de nascimento</label>
                        <input type="date" name="data_nascimento" id="data_nascimento" required />
                   <label>Gênero</label>
                        <div id="genero">
                            
                            <input type="radio" name="genero" id="genero_masculino" value="M" required>
                            <label for="genero_masculino">Masculino</label>
                            <br>
                            <input type="radio" name="genero" id="genero_feminino" value="F" required>
                            <label for="genero_feminino">Feminino</label>
                        </div>
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
                        <input type="text" name="cep" id="cep"/>
                    <label for="logradouro">Logradouro</label>
                        <input type="text" name="logradouro" id="logradouro"/>
                    <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" id="bairro"/>
                    <label for="numero">Número</label>
                        <input type="text" name="numero" id="numero"/>
                    <label for="complemento">Complemento</label>
                        <input type="text" name="complemento" id="complemento"/>
                </div>    
                <button type="submit" name="registrar">Entrar</button>
	    	</form>
		</div>
    <?=$this->endSection()?>
                                