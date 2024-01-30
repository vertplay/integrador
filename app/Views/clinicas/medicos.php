<?php $this->extend('layout')?>
	
<?= $this->section('content'); ?>


<div id="perfil-pag">
    <div id="clin-block1" class="clin-block">
        <?php foreach($dados as $dado){ $dado = $dado[0]; ?>

            <div class="info">
					<h3><?=$dado['Nome_medico']?></h3>
					<p>Especialidade: <?=$dado['Especialidade_medico']?></p>
                    <p>CRM: <?=$dado['CRM_medico']?></p>
					</div>

        <?php } ?>    
    </div>

    <div id="clin-block2" class="clin-block">
        <div class="update-form formularios" id="update-form">
			<h2>Cadastrar Médico</h2>
			<h6></h6>
			<form id="update-form" action="<?=base_url('??')?>" method="POST" enctype="multipart/form-data">
            <br/>
                <label for="nome_medico">Nome do médico:</label>
                    <input type="text" name="nome_medico" id="nome_medico" required/>
                    <div class="error-message"></div>
                <label for="especialidade_medico">Especialidade:</label>
                    <input type="text" name="especialidade_medico" id="especialidade_medico" required/>
                    <div class="error-message"></div>
                <label for="crm_medico">CRM:</label>
                   <input type="text" name="crm_medico" id="crm_medico" required/>
                    <div class="error-message"></div>

				<button type="submit" name="cadastrar">Cadastrar</button>
					<button type="button" id="cancelarUpdate_btn">Cancelar</button>
			</form>
		</div>
    </div>

</div>



<?=$this->endSection()?>