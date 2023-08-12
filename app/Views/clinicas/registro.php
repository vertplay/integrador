<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>
    <script src="<?=base_url("js/validarsenha.js") ?>"> </script>
        <div class="reg-form formularios">
            <h2>Registro</h2>
			<form id= "userform"action="<?=base_url('pe/registro')?>" method="POST" enctype="multipart/form-data">
                <label for="login">CNPJ</label><br>
                    <input type="text" name="login" id="login" required><br>
                <label for="nome">Nome Fantasia</label><br>
                    <input type="text" name="nome" id="nome" required><br>
                <label for="senha">Senha</label><br>
                    <input type="password" name="senha" id="senha" required><br>
                    <input type="file" name="arquivo" required><br>

                <label for="endereco" class="sub_bloco-titulo">Endereço</label>
                <div class="sub_bloco" id="endereco">
                    <label for="logradouro">Logradouro</label>
                        <input type="text" name="endereco" id="logradouro"/>
                    <label for="bairro">Bairro</label>
                        <input type="text" name="bairro" id="bairro"/>
                    <label for="numero">numero</label>
                        <input type="text" name="numero" id="numero"/>
                    <label for="complemento">Complemento</label>
                        <input type="text" name="complemento" id="complemento"/>
                </div>
                <label for="contato">Contato</label> 
                <div class="sub_bloco" id="contato">
                    <label for="email">E-mail</label>
                        <input type="email" name="email" id="email"/>
                    <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" id="telefone"/>
                    <label for="whatsapp">Whatsapp</label>
                        <input type="text" name="whatsapp" id="whatsapp"/>
                    <label for="instagram">Instagram</label>
                        <input type="text" name="instagram" id="instagram" placeholder="@"/>
                </div>

                <button type="submit" name="registrar">Cadastrar</button>
	    	</form>
		</div>

    <?php if ($this->session->flashdata('error_message')): ?>
        <div class="error-message">
            <?php echo $this->session->flashdata('error_message'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('success_message')): ?>
        <div class="success-message">
            <?php echo $this->session->flashdata('success_message'); ?>
        </div>
    <?php endif; ?>


    <?=$this->endSection()?>