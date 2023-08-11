<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>
	<?php $session = session();?>
		<div id="index-center">
		
			<div id="index-text">
				<h1>AraClin: Catálogo de Clínicas Médicas</h1>
				<h2>Seu guia confiável para cuidar da sua saúde!</h2>
				<a href="#list">ENCONTRE UMA CLÍNICA</a>
			</div>
		</div>
		
		<div id="list">
		
			<input type="text" id="search-bar" placeholder="Pesquise por uma clínica, especialidade ou médico...">
			
			<?php foreach($dados as $dado){ ?>

				<a class="container-blocks" href="<?=base_url('/clinica/'.$dado['ID_clinica'])?>">
					<img src="<?=base_url('/img/'.$dado['ID_clinica'])?>"/>
					<div class="container-block-text">
						<?=$dado['Nome_fantasia_clinica']?>
						<div class="block-text-sub">Saiba Mais</div>
					</div>
					<div class="container-block-text2">
						3,5
					</div>
				</a>
				
			<?php } ?>

		</div>

	<?=$this->endSection()?>

			
		