<?php
require_once("classes/autoload.php");
$oController = new ControllerMapaDeConsultas();

$oMapaDeConsultas = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes MapaDeConsultas <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oMapaDeConsultas->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LatDestino</label>
	</div>
	<div class="col-md-9">
		<?=$oMapaDeConsultas->latDestino?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LatOrigem</label>
	</div>
	<div class="col-md-9">
		<?=$oMapaDeConsultas->latOrigem?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LngDestino</label>
	</div>
	<div class="col-md-9">
		<?=$oMapaDeConsultas->lngDestino?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LngOrigem</label>
	</div>
	<div class="col-md-9">
		<?=$oMapaDeConsultas->lngOrigem?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>DataBusca</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataHoraBancoForm($oMapaDeConsultas->dataBusca)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Cidade</label>
	</div>
	<div class="col-md-9">
		<?=$oMapaDeConsultas->oCidade->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>