<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdMapaDeConsultas();

$oBgdMapaDeConsultas = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes BgdMapaDeConsultas <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Data_captura</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataHoraBancoForm($oBgdMapaDeConsultas->data_captura)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LatDestino</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->latDestino?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LatOrigem</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->latOrigem?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LngDestino</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->lngDestino?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LngOrigem</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->lngOrigem?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lat_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->lat_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lng_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->lng_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Fonte</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdMapaDeConsultas->fonte?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>