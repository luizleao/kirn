<?php
require_once("classes/autoload.php");
$oController = new ControllerCoordenada();

$oCoordenada = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Coordenada <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oCoordenada->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Latitude</label>
	</div>
	<div class="col-md-9">
		<?=$oCoordenada->latitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Longitude</label>
	</div>
	<div class="col-md-9">
		<?=$oCoordenada->longitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Trechocomentario</label>
	</div>
	<div class="col-md-9">
		<?=$oCoordenada->oTrechocomentario->id?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>