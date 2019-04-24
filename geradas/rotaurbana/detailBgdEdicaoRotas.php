<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdEdicaoRotas();

$oBgdEdicaoRotas = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes BgdEdicaoRotas <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>CodigoLinha</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->codigoLinha?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>ComentarioLinha</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->comentarioLinha?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Data_captura</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataHoraBancoForm($oBgdEdicaoRotas->data_captura)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>NomeLinhas</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->nomeLinhas?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdLinha</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->oBgdLinha->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdUsuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->oBgdUsuario->email?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lat_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->lat_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lng_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->lng_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Fonte</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoRotas->fonte?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>