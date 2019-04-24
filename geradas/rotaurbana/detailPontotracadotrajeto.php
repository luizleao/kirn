<?php
require_once("classes/autoload.php");
$oController = new ControllerPontotracadotrajeto();

$oPontotracadotrajeto = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Pontotracadotrajeto <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oPontotracadotrajeto->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Latitude</label>
	</div>
	<div class="col-md-9">
		<?=$oPontotracadotrajeto->latitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Longitude</label>
	</div>
	<div class="col-md-9">
		<?=$oPontotracadotrajeto->longitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Posicao</label>
	</div>
	<div class="col-md-9">
		<?=$oPontotracadotrajeto->posicao?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Linha_id</label>
	</div>
	<div class="col-md-9">
		<?=$oPontotracadotrajeto->linha_id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Tipo</label>
	</div>
	<div class="col-md-9">
		<?=$oPontotracadotrajeto->tipo?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>