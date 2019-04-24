<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdOrigemAcesso();

$oBgdOrigemAcesso = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes BgdOrigemAcesso <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdOrigemAcesso->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Data_captura</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataHoraBancoForm($oBgdOrigemAcesso->data_captura)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lat_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdOrigemAcesso->lat_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lng_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdOrigemAcesso->lng_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Origem_acesso</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdOrigemAcesso->origem_acesso?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdOrigemAcesso->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Fonte</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdOrigemAcesso->fonte?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>