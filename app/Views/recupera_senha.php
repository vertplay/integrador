<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>
    <div class="resetpassword-form formularios">
            <h2>Recuperar senha</h2>
			<form action="<?=base_url('/recuperacao')?>" method="POST" enctype="multipart/form-data">
                <label for="login">Email</label><br>
                    <input type="email" name="email" id="login" required placeholder="Informe o e-mail cadastrado"><br>
                
                <button type="submit" name="recuperar">Enviar</button>
	    	</form>
		</div>
    <?=$this->endSection()?>