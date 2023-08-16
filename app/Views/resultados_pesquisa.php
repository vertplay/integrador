<?php $this->extend('layout') ?>

<?=$this->section('content')?>

<div id="list">
    <?php if (!empty($resultados)) { ?>
        <div class="search-results-msg">
            <br>Mostrando resultados para <?= esc($termoPesquisa) ?>
        </div>

        <?php foreach($resultados as $dado){ ?>
            <a class="container-blocks" href="<?=base_url('/clinica/'.$dado['ID_clinica'])?>">
                <img src="<?=base_url('/img/'.$dado['ID_clinica'])?>"/>
                <div class="container-block-text">
                    <?=$dado['Nome_fantasia_clinica']?>
                    <div class="block-text-sub">Saiba Mais</div>
                </div>
                <div class="container-block-text2">
                       <?php
                       if ($dado['Media_Avaliacao'] !== null) {
                           $media_avaliacao = $dado['Media_Avaliacao'];
                           echo number_format($media_avaliacao, 1) . " &#9733;";
                       } 
                       else {
                           echo "Sem pontuação";
                       }
                   ?>
                </div>
            </a>
        <?php } ?>

        <?php } else { ?>
            <div>
                <br>Nenhum resultado encontrado para <?= esc($termoPesquisa) ?> . </br>Tente pesquisar por outra palavra!
            </div>

            <script>
                setTimeout(function() {
                    window.history.back();
                }, 3000); 
            </script>
        <?php } ?>
</div>

<?=$this->endSection()?>

