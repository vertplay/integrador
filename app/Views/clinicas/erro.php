<?php $this->extend('layout')?>
	
<?= $this->section('content'); ?>
<!-- Seu conteúdo da página aqui -->
<!-- Exibir as mensagens aqui -->
<?php if (session()->has('error_message')) : ?>
    <div class="alert alert-danger formularios">
        <strong></strong> <?= session('error_message') ?>
    </div>
<?php endif; ?>
<?php if (session()->has('success_message')) : ?>
    <div class="alert alert-success formularios">
        <strong></strong> <?= session('success_message') ?>
    </div>
<?php endif; ?>
	

<?=$this->endSection()?>