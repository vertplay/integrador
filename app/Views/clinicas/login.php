<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>
        <script src= "<?=base_url('js/mostrasenhalogin.js')?>"> </script>
        <div class="login-form formularios">
            <h2>Log In</h2>
			<form id = "formlogin"action="<?=base_url('pe/login')?>" method="POST" enctype="multipart/form-data">
                <label for="login">Email</label><br>
                    <input type="text" name="login" id="login" required><br>
                <label for="senha">Senha</label><br>
                    <input type="password" name="senha" id="senha" required>
                    <button type="button" id="mostrar_senha"><i class="material-icons">visibility</i></button>
                    <br>
                <button type="submit" name="logar">Entrar</button>
				<div id="recup-link"><a href="<?=base_url('recuperacao')?>">Esqueceu a senha?</a></div>
				<div id="reg-link">ainda não possui uma conta? <a href="<?=base_url('pe/registro')?>">registrar</a></div>
	    	</form>
		</div>

    <?=$this->endSection()?>