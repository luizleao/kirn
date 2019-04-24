<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdParada();

$oBgdParada = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes BgdParada <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdParada->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Comments</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdParada->comments?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Latitude</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdParada->latitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Longitude</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdParada->longitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Title</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdParada->title?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>