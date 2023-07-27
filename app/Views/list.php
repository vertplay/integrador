<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>
		<?=
		'<div style="width:100%;margin-top:80px;text-align:center;"><h1>Catalogo de Clínicas</h1></div>'
		?>
		<?php foreach($dados as $dado){ ?>

			<a class="container-blocks" href="<?=base_url('/user/'.$dado['id'])?>">
				<img src="<?=base_url('/img/'.$dado['id'])?>"/>
				<div class="container-block-text">
					<?=$dado['nome']?>
				</div>
			</a>
			
		<?php } ?>


	<?=$this->endSection()?>

			
		