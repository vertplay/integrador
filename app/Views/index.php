<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>
		<div id="index-center">
		
			<div id="index-text">
				<h1>AraClín: Catálogo de Clínicas Médicas</h1>
				<h2>Seu guia confiável para cuidar da sua saúde!</h2>
				<a href="#list">ENCONTRE UMA CLÍNICA</a>
			</div>
		</div>
		
		<div id="list">
		
			<input type="text" id="search-bar" placeholder="Pesquise por uma clínica, especialidade ou médico...">
			
			<?php foreach($dados as $dado){ ?>

				<a class="container-blocks" href="<?=base_url('/user/'.$dado['id'])?>">
					<img src="<?=base_url('/img/'.$dado['id'])?>"/>
					<div class="container-block-text">
						<?=$dado['nome']?>
					</div>
				</a>
				
			<?php } ?>

		</div>

	<?=$this->endSection()?>

			
		