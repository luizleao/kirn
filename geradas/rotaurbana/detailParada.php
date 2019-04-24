<?php
require_once("classes/autoload.php");
$oController = new ControllerParada();

$oParada = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Parada <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oParada->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Latitude</label>
	</div>
	<div class="col-md-9">
		<?=$oParada->latitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Longitude</label>
	</div>
	<div class="col-md-9">
		<?=$oParada->longitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Status</label>
	</div>
	<div class="col-md-9">
		<?=$oParada->status?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Comments</label>
	</div>
	<div class="col-md-9">
		<?=$oParada->comments?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Title</label>
	</div>
	<div class="col-md-9">
		<?=$oParada->title?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>TipoDeRotaDaParada</label>
	</div>
	<div class="col-md-9">
		<?=$oParada->tipoDeRotaDaParada?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>