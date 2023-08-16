<?php $session = session(); ?>
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
		
		<!--FIM CSS e JS-->
		<!--favicon-->
		
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-16x16.png" sizes="16x16"/>
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-32x32.png" sizes="32x32"/>
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-48x48.png" sizes="48x48"/>
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-64x64.png" sizes="64x64"/>
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-128x128.png" sizes="128x128"/>
		
		
		<link rel="icon" href="<?php echo base_url()?>/img/favicon-64x64.png"/>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

		
		
			<!--WINDOWS 8 TILE-->
			<meta name="msapplication-TileImage" content="img/tile.png"/>
			<meta name="msapplication-TileColor" content="#000000"/>
			
		
		<title>AraClin</title>
	</head>
	<body>
		<!--MENU-->
		<nav id="menu-bar">
			<a id="home-link" href="<?=base_url()?>">AraClin</a>
			<?php
				if($session->has('ID_clinica') && $session->get('tipo') == "pe"){
					echo '
					<div id="btn-group">
						<a href="'.base_url('pe/perfil').'" id="menu-btn-emp">Perfil</a>
						<form action="'.base_url('/pe/logout').'" method="post"">
						<button type="submit" name="sair">LogOut</button>
						</form>
					</div>
					';
				}
				elseif($session->has('ID_usuario') && $session->get('tipo') == "pp"){
					echo '
					<div id="btn-group">
						<a href="'.base_url('pp/perfil').'" id="menu-btn-user">Perfil</a>
						<form action="'.base_url('/pp/logout').'" method="post"">
						<button type="submit" name="sair">LogOut</button>
						</form>
					</div>
					';
				}else{
					echo'
					<div id="btn-group">
						<a href="'.base_url('pp/login').'" id="menu-btn-user">Perfil Pessoal</a>
						<a href="'.base_url('pe/login').'" id="menu-btn-emp">Perfil Empresarial</a>
					</div>
					';
				}
			?>
		</nav>
		<!--Bloco central-->
        <div id="container-principal">
            <?= $this->renderSection('content') ?>
        </div>
		<!--FOOTER-->
		<footer>
			&copy;2023
		</footer>
			
	</body>
</html>