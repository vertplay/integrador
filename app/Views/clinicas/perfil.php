<?php $this->extend('layout')?>
		
	
    <?php $session = session();
        if(!$session->has('ID_clinica') || $session->has('ID_usuario')){
            return redirect()->to(base_url()); // retorna ao inicio caso não exista sessão
        }
        if($session->has('ID_clinica') && $session->get('Nome_fantasia_clinica') != null){//caso usuário clínica
            $this->section('content');?>
        
    
    
            <div id="clin-block1" class="clin-block">
				<div class="title"><?= $session->get('Nome_fantasia_clinica') ?></div>
				<div class="info">
					<h3>Descrição:</h3>
				<p>&nbsp;Nessa seção, o paciente ou responsável descobrirá, a partir da leitura, quais são as especialidades 
					médicas ofertadas pela clínica, quem são os profissionais da saúde que prestam atendimento e quais exames e procedimentos são realizados. 
					Além disso, poderá visualizar imagens do exterior e interior do estabelecimento.</p>
				</div>
				<div id="album-block-img">
					<img src="<?= base_url('/img/'.$session->get('ID_clinica'))?>"/>
				</div>
				<div class="info">
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
					<p>Telefone: (33)3731-1834<br>
					WhatsApp: link.para.chat.do.whatsapp<br>
					Intagram: link.para.perfil.do.intagram<br>
					Email: clinicamedmaria@outlook.com</p>
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

        <?php }elseif($session->has('ID_usuario') && $session->get('Nome_usuario') != null){//caso usuário pessoa física
            $this->section('content');?>
        



    <?php } $this->endSection()?>