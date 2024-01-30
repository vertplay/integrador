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

    </div>

</div>



<?=$this->endSection()?>