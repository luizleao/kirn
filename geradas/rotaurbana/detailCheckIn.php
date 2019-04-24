<?php
require_once("classes/autoload.php");
$oController = new ControllerCheckIn();

$oCheckIn = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes CheckIn <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oCheckIn->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PosicaoAtual</label>
	</div>
	<div class="col-md-9">
		<?=$oCheckIn->posicaoAtual?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Linha</label>
	</div>
	<div class="col-md-9">
		<?=$oCheckIn->oLinha->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Latitude</label>
	</div>
	<div class="col-md-9">
		<?=$oCheckIn->latitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Longitude</label>
	</div>
	<div class="col-md-9">
		<?=$oCheckIn->longitude?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>