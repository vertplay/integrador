<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!--META TAGS-->
		<meta charset="UTF-8">
		<meta name="keywords" content=" ....">
		<meta name="description" content="......">
		<meta name="author" content="....autores">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--FIM META TAGS-->
		<!--CSS e JS-->
		<link rel="stylesheet" href="<?=base_url('/css/structure.css')?>"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
			<!--THEMES-->
			<link rel="stylesheet" href="<?=base_url('/css/green.css')?>" id="green-theme"/>
			<!--incluir preferências de usuário-->
			<!-- <script type="text/javascript">
				var theme_blocked = localStorage.getItem('blocked_theme')+"-theme";
				document.getElementById(theme_blocked).disabled=true;
			</script> -->
		
		<!--FIM CSS e JS-->
		<!--favicon-->
		
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-16x16.png" sizes="16x16"/>
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-32x32.png" sizes="32x32"/>
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-48x48.png" sizes="48x48"/>
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-64x64.png" sizes="64x64"/>
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-128x128.png" sizes="128x128"/>
		
		
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-64x64.png"/>
		
		
			<!--WINDOWS 8 TILE-->
			<meta name="msapplication-TileImage" content="img/tile.png"/>
			<meta name="msapplication-TileColor" content="#000000"/>
			
		
		<title>AraClin</title>
	</head>
	<body>
		<!--MENU-->
		<nav id="menu-bar">
			<a id="home-link" href="<?php echo base_url()?>">AraClin</a>
			
			<!--BARRA DE PESQUISA-->
			<!-- <input id="search-bar" type="text" placeholder="Pesquisar..."/> -->
			
			<!--GRUPO DE BOTÕES-->
			<div id="btn-group">
				<a id="menu-btn-user">Perfil Pessoal</a>
				<a id="menu-btn-emp">Perfil Empresarial</a>
			</div>
			
			
		</nav>
		<!--BLOCOS DE MENU-->
			<!--USER-->
		<?php
			if((bool)session()->isLoggedIn != true){
				echo '
				<div class="menu-block" id="menu-block-user">
				<form action="./login" method="POST" enctype="multipart/form-data">
				<label for="login">Login</label>
					<input type="text" name="login" id="login" required><br>
				<label for="senha">Senha</label>
					<input type="password" name="senha" id="senha" required><br>
					<input type="file" name="arquivo" required><br>
					<button type="submit" name="registrar">Enviar</button>
				</form>
				</div>
				
				';
			}
			else{
				echo '
				<div class="menu-block" id="menu-block-user">
				Conectado
				<a href="./logout">Sair</a>
				</div>
				
				';
			}

		?>
			<!--MENU-->
			<div class="menu-block" id="menu-block-menu">
				<div class="line">THEME/TEMA</div>
				<button type="button" class="menu-btn-theme" id="menu-btn-theme-dark">DARK</button>
				<button type="button" class="menu-btn-theme" id="menu-btn-theme-light">LIGHT</button>
			</div>
		<script src="<?=base_url('/js/menu.js')?>" type="text/javascript"></script>
		<!--FIM MENU-->
		
        <div id="container-principal">
            <?= $this->renderSection('content') ?>
        </div>
		<!--FOOTER-->
		<footer>
			&copy;2023
		</footer>
		
	</body>
</html>