<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>

        <div class="menu-block" id="menu-block-user">
			<form action="<?=base_url('login')?>" method="POST" enctype="multipart/form-data">
                <label for="login">Login</label>
                    <input type="text" name="login" id="login" required><br>
                <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" required><br>
                    <input type="file" name="arquivo" required><br>
                <button type="submit" name="registrar">Enviar</button>
	    	</form>
		</div>

    <?=$this->endSection()?>