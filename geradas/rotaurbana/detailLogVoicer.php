<?php
require_once("classes/autoload.php");
$oController = new ControllerLogVoicer();

$oLogVoicer = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes LogVoicer <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oLogVoicer->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Compreendido</label>
	</div>
	<div class="col-md-9">
		<?=$oLogVoicer->compreendido?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>IdUsuario</label>
	</div>
	<div class="col-md-9">
		<?=$oLogVoicer->idUsuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>MenuAtual</label>
	</div>
	<div class="col-md-9">
		<?=$oLogVoicer->menuAtual?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Momento</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataHoraBancoForm($oLogVoicer->momento)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Resultado</label>
	</div>
	<div class="col-md-9">
		<?=$oLogVoicer->resultado?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>