<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdDistanciaRotaConsulta();

$oBgdDistanciaRotaConsulta = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes BgdDistanciaRotaConsulta <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdDistanciaRotaConsulta->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Data_captura</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataHoraBancoForm($oBgdDistanciaRotaConsulta->data_captura)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Distancia</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdDistanciaRotaConsulta->distancia?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdDistanciaRotaConsulta->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdLinha</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdDistanciaRotaConsulta->oBgdLinha->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Fonte</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdDistanciaRotaConsulta->fonte?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>