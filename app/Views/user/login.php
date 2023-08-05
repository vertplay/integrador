<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>

        <div class="login-form formularios">
            <h2>Log In</h2>
			<form action="<?=base_url('pp/login')?>" method="POST" enctype="multipart/form-data">
                <label for="login">Usuário</label><br>
                    <input type="text" name="login" id="login" required><br>
                <label for="senha">Senha</label><br>
                    <input type="password" name="senha" id="senha" required><br>
                <button type="submit" name="registrar">Entrar</button>
				<div id="recup-link"><a href="#">Esqueceu a senha?</a></div>
				<div id="reg-link">ainda não possui uma conta? <a href="<?=base_url('pp/registro')?>">registrar</a></div>
	    	</form>
		</div>

    <?=$this->endSection()?>