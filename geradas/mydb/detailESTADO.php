<?php
require_once("classes/autoload.php");
$oController = new ControllerESTADO();

$oESTADO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes ESTADO <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oESTADO->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oESTADO->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PAIS</label>
	</div>
	<div class="col-md-9">
		<?=$oESTADO->oPAIS->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Uf</label>
	</div>
	<div class="col-md-9">
		<?=$oESTADO->uf?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>