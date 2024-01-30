<?php $this->extend('layout')?>	
	<?=$this->section('content')?>
        <script src="<?=base_url('js/validarsenha.js')?>"></script>
        <script src="<?=base_url('js/mostrasenha.js')?>"></script>
        <script src="<?=base_url('js/checkusuario.js')?>"></script>
        <div class="reg-form formularios">
        <div id="reg-link">Deseja registrar sua clínica? <a href="<?=base_url('pe/registro')?>">Registre-se</a></div>
            <h2>Registro</h2>
			<form id = "userform" action="<?=base_url('pp/registro')?>" method="POST" enctype="multipart/form-data">
                <label for="nome_completo">Nome Completo</label><br>
                    <input type="text" name="nome" id="nome" required><br>        
                <label for="senha">Senha</label><br>
                    <input type="password" name="formsenha" id="formsenha" required>
                    <button type="button" id="mostrar_senha"><i class="material-icons">visibility</i></button>
                    <div id="alerta_senha"> </div>
                    

                <!--Informações-->    
                <label for="informacoes" class="sub_bloco-titulo">Info</label>
                <div class="sub_bloco" id="informacoes">
                    <label for="email">Email</label>
                        <input type="email" name="email" id="email" required/>
                    <label for="whatsapp">Whatsapp</label>
                        <input type="number" name="whatsapp" id="whatsapp" pattern="[0-9]*" required/>
                    <label for="telefone">Telefone</label>
                        <input type= "number" name="telefone" id="telefone" pattern="[0-9]*" required>
                </div>
                <button type="submit" name="registrar">Cadastrar</button>
                
	    	</form>
		</div>
    <?=$this->endSection()?>
                                