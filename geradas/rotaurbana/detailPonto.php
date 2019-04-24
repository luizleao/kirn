<?php
require_once("classes/autoload.php");
$oController = new ControllerPonto();

$oPonto = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Ponto <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oPonto->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Latitude</label>
	</div>
	<div class="col-md-9">
		<?=$oPonto->latitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Longitude</label>
	</div>
	<div class="col-md-9">
		<?=$oPonto->longitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Linha_id</label>
	</div>
	<div class="col-md-9">
		<?=$oPonto->linha_id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>CodigoAndroid</label>
	</div>
	<div class="col-md-9">
		<?=$oPonto->codigoAndroid?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>