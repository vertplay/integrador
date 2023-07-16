<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>
	
		<?php foreach($dados as $dado){ ?>

			<a class="container-blocks" href="<?=base_url('/user/'.$dado['id'])?>">
				<img src="<?=base_url('/img/'.$dado['id'])?>"/>
				<div class="container-block-text">
					<?=$dado['nome']?>
				</div>
			</a>
			
		<?php } ?>


	<?=$this->endSection()?>

			
		