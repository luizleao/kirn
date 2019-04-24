<?php
require_once("classes/autoload.php");
$oController = new ControllerPERMISSAO();

$oPERMISSAO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes PERMISSAO <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oPERMISSAO->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Alteracao</label>
	</div>
	<div class="col-md-9">
		<?=$oPERMISSAO->alteracao?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Insercao</label>
	</div>
	<div class="col-md-9">
		<?=$oPERMISSAO->insercao?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Exclusao</label>
	</div>
	<div class="col-md-9">
		<?=$oPERMISSAO->exclusao?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Visualizacao</label>
	</div>
	<div class="col-md-9">
		<?=$oPERMISSAO->visualizacao?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>