<?php
require_once("classes/autoload.php");
$oController = new ControllerPontopesquisa();

$oPontopesquisa = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Pontopesquisa <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oPontopesquisa->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Latitude</label>
	</div>
	<div class="col-md-9">
		<?=$oPontopesquisa->latitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Longitude</label>
	</div>
	<div class="col-md-9">
		<?=$oPontopesquisa->longitude?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Posicao</label>
	</div>
	<div class="col-md-9">
		<?=$oPontopesquisa->posicao?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Tipo</label>
	</div>
	<div class="col-md-9">
		<?=$oPontopesquisa->tipo?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Linha</label>
	</div>
	<div class="col-md-9">
		<?=$oPontopesquisa->oLinha->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>