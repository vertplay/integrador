<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>
		<?php 
		function formataTelefone($tel){
			if(strlen($tel) == 10){
				$telefone = substr_replace($tel, '(', 0, 0);
				$telefone = substr_replace($telefone, '9', 3, 0);
				$telefone = substr_replace($telefone, ')', 3, 0);
				$telefone = substr_replace($telefone, '-', 9, 0);
			}else{
				$telefone = substr_replace($tel, '(', 0, 0);
				$telefone = substr_replace($telefone, ')', 3, 0);
				$telefone = substr_replace($telefone, '-', 9, 0);
			}
			return $telefone;
		}
    ?>
			<div id="clin-block1" class="clin-block">
				<div class="title"><?= $clin["Nome_fantasia_clinica"] ?></div>
				<div class="info">
					<h3>Descrição:</h3>
				<p>&nbsp;<?=$clin["Descricao_clinica"]?></p>
				</div>
				<div id="album-block-img">
					<img src="<?= base_url('/img/'.$clin["ID_clinica"])?>"/>
				</div>
				<div class="info"> <!--sem dados no BD -->
					<h3>Horário de Funcionamento:</h3>
				<p>Segunda-feira: 07:00 às 20:00.<br>
					Terça-feira: 07:00 às 20:00.<br>
					Quarta-feira: 07:00 às 20:00.<br>
					Quinta-feira: 07:00 às 20:00.<br>
					Sexta-feira: 07:00 às 20:00.<br>
					Sábado: 07:00 às 11:00.<br>
					Domingo: Fechado</p>
				</div>
				<div class="info">
					<h3>Contato:</h3>
					<p>Telefone: <?=formataTelefone($clin['Telefone_clinica'])?><br>
					WhatsApp: <a target="_blank" href="https://api.whatsapp.com/send?phone=55<?=$clin['Whatsapp_clinica']?>"><?=formataTelefone($clin['Whatsapp_clinica'])?></a><br>
					Intagram: <a target="_blank" href="https://www.instagram.com/<?=$clin['Instagram_clinica']?>">@<?=$clin['Instagram_clinica']?></a><br>
					Email: <?=$clin['Email_clinica']?></p>
				</div>
			</div>

			<div id="clin-block2" class="clin-block">
				<div class="info">
					<h3>Endereço:</h3>
					<p>
					Av. das Rosas, 40 - Alto Mercado, Araçuaí - MG, 39600-000</p>
					
				</div>
				<div id="mapa">

				</div>
				<div class="info">
					<h3>Nota e Avaliações:</h3>
					<p>
						<!-- Exibir notas e avaliações aqui -->
					</p>

    			</div>
			</div>

			
	<?=$this->endSection()?>
		
		