<?php $this->extend('layout')?>
		
	<?=$this->section('content')?>
		
		
		
			<div id="album-block">
				<div id="album-block-img">
					<img src="<?php echo base_url()?>/img/<?php echo $user["id"] ?>"/>
				</div>
				<div class="title"><?php echo $user["nome"] ?></div>
				<div class="info">
				<p>&nbsp;REOL (stylized as RΞOL) is a Japanese musical unit that consists of vocalist/lyricist Reol,
				music arranger GigaP, and movie director/producer Okiku. The members from REOL originally worked 
				as solo artists, but they signed to Toy's Factory as a group in 2015, using Reol's name for the project.
				Prior to its formation, both Reol and GigaP consistently worked together, eventually releasing an album together
				titled No Title, while Reol worked as a solo artist. However, all three members released their debut studio album,
				Sigma, on October 19, 2016.</p>
				</div>
			</div>
			<div id="music-list">
				<div class="item">
					<div class="name">Kamisama Ni Natta Hi</div>
					<i class="material-icons" onclick="alter_music('[REOL]Kamisama Ni Natta Hi.mp3')">play_arrow</i>
				</div>
				<div class="item">
					<div class="name">World's Greatest Battle Music Ever  Fortuna Redux (Fractal Dreamers)</div>
					<i class="material-icons" onclick="music_player.change_music('[1]0.mp3','fortuna redux')">play_arrow</i>
				</div>
				<div class="item">
					<div class="name">World's Greatest Battle Music Ever  Fortuna Redux (Fractal Dreamers)</div>
					<i class="material-icons" onclick="alter_music('[rola]Worlds Greatest Battle Music Ever  Fortuna Redux (Fractal Dreamers).mp3')">play_arrow</i>
				</div>
				<div class="item">
					<div class="name">World's Greatest Battle Music Ever  Fortuna Redux (Fractal Dreamers)</div>
					<i class="material-icons" onclick="alter_music('[rola]Worlds Greatest Battle Music Ever  Fortuna Redux (Fractal Dreamers).mp3')">play_arrow</i>
				</div>
			<?php
			foreach($musicas as $musica){
				echo '
					<div class="item">
						<div class="name">'.$musica["nome"].'</div>
						<i class="material-icons" onclick="music_player.change_music(\''.$musica["arquivo"].'\',\''.$musica["nome"].'\')">play_arrow</i>
					</div>
				';
			}
			?>
			</div>
	<?=$this->endSection()?>
		
		