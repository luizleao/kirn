<?php
require_once("classes/autoload.php");
$oController = new ControllerCidade();

$oCidade = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Cidade <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oCidade->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Latitude</label>
	</div>
	<div class="col-md-9">
		<?=$oCidade->latitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Longitude</label>
	</div>
	<div class="col-md-9">
		<?=$oCidade->longitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Estado</label>
	</div>
	<div class="col-md-9">
		<?=$oCidade->oEstado->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Cidade</label>
	</div>
	<div class="col-md-9">
		<?=$oCidade->oCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>SameAs</label>
	</div>
	<div class="col-md-9">
		<?=$oCidade->sameAs?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LatitudeDouble</label>
	</div>
	<div class="col-md-9">
		<?=$oCidade->latitudeDouble?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LongitudeDouble</label>
	</div>
	<div class="col-md-9">
		<?=$oCidade->longitudeDouble?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>