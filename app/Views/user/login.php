<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>

        <div class="login-form formularios">
            <h2>Log In</h2>
			<form action="<?=base_url('login')?>" method="POST" enctype="multipart/form-data">
                <label for="login">Usuário</label><br>
                    <input type="text" name="login" id="login" required><br>
                <label for="nome">Nome</label><br>
                    <input type="text" name="nome" id="nome" required><br>
                <label for="senha">Senha</label><br>
                    <input type="password" name="senha" id="senha" required><br>
                    <input type="file" name="arquivo" required><br>
                <button type="submit" name="registrar">Entrar</button>
	    	</form>
		</div>

    <?=$this->endSection()?>