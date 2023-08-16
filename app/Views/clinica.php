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
				
				<div class="info">
					</br>
					<h3>Contato:</h3>
					<p>Telefone: <?=formataTelefone($clin['Telefone_clinica'])?><br>
					WhatsApp: <a target="_blank" href="https://api.whatsapp.com/send?phone=55<?=$clin['Whatsapp_clinica']?>"><?=formataTelefone($clin['Whatsapp_clinica'])?></a><br>
					Intagram: <a target="_blank" href="https://www.instagram.com/<?=$clin['Instagram_clinica']?>">@<?=$clin['Instagram_clinica']?></a><br>
					Email: <?=$clin['Email_clinica']?></p>
				</div>

				<div class="info">
				</br>
				<h3>Endereço:</h3>
					<p>
					<?= $clin['Logradouro'] ?>, <?= $clin['Numero'] ?> - <?= $clin['Bairro'] ?>, <?= $clin['Complemento'] ?> - Araçuaí, MG, <?= $clin['Cep'] ?>.
					</p>

				</div>

			</div>



			
				
			<div id="clin-block2" class="clin-block">
				<div class="info">
					<h3>Endereço:</h3>
					<p>
					<?=$clin['Logradouro']?>, <?=$clin['Numero']?> - <?=$clin['Bairro']?>, Araçuaí - MG, 39600-000</p>

				</div>

				<div class="info">
					<h3>Avaliações:</h3>
					<div id="comentarios">

					<?php if ($ID_usuario) : ?>

						<form action="<?= base_url('/clinica/enviaravaliacao') ?>" method="post" name="formComentario" id="formComentario"> 
							<p><strong>Avalie esta clínica</strong></p>
							
							<ul class="avaliacao">
								<li class="star-icon ativo" data-avaliacao="1"></li>
								<li class="star-icon" data-avaliacao="2"></li>
								<li class="star-icon" data-avaliacao="3"></li>
								<li class="star-icon" data-avaliacao="4"></li>
								<li class="star-icon" data-avaliacao="5"></li>
							</ul>

							<input type="hidden" name="ID_clinica" value="<?= $clin['ID_clinica'] ?>">
							<input type="hidden" name="nota_avaliacao" id="nota_avaliacao" value="notaAvaliacao">
							<input type="text" name="comentario" size="150" placeholder="Descreva sua experiência" required>
							<button type="submit" class="btn-avaliar"> <i class="fas fa-paper-plane"></i> Enviar</button>
							<br>
						</form>
						
					<?php else : ?>
						<div>
							Faça o login para avaliar esta clinica.
						</div>
						<br>
					<?php endif; ?>

					<?php if (!empty($avaliacoes)) : ?>
						<?php foreach ($avaliacoes as $avaliacao) : ?>
							<div class="comentarios">
								<p><strong><?= $avaliacao['Nome_usuario'] ?></strong></p>
								<p><?= str_repeat('&#9733;', $avaliacao['Nota_avaliacao']) ?></p>
								<p><?= $avaliacao['Texto_avaliacao'] ?></p>
							</div>
						<?php endforeach; ?>
					<?php else : ?>
						<p>Nenhuma avaliação para esta clínica.</p>
					<?php endif; ?>
				</div>
			</div>

			<script>
				var stars = document.querySelectorAll('.star-icon');
				var notaAvaliacao = document.getElementById('nota_avaliacao');

				stars.forEach(function(star) {
					star.addEventListener('click', function(e) {
						var avaliacao = e.target.getAttribute('data-avaliacao');
						notaAvaliacao.value = avaliacao;
						stars.forEach(function(s) {
							s.classList.remove('ativo');
						});
						star.classList.add('ativo');
					});
				});
			</script>

	<?=$this->endSection()?>
		
		