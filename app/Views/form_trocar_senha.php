<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>

        <div class="recupera_senha-form formularios">
            <h2>Informe a nova senha</h2>
			<form action="<?=base_url('alterar_senha')?>" method="POST" enctype="multipart/form-data">
                <label for="senha">Senha</label><br>
                    <input type="password" name="senha" id="senha" required><br>
                <label for="confirmsenha">Confirme a Senha</label><br>
                    <input type="password" name="confirmsenha" id="confirmsenha" required><br>
                <button type="submit" name="Enviar" value="<?=$codigo?>">Enviar</button>
	    	</form>
		</div>

    <?=$this->endSection()?>