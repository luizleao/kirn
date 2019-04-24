<?php
require_once("classes/autoload.php");
$oController = new ControllerCLIENTE();

$oCLIENTE = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes CLIENTE <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oCLIENTE->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Status</label>
	</div>
	<div class="col-md-9">
		<?=$oCLIENTE->status?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PESSOA</label>
	</div>
	<div class="col-md-9">
		<?=$oCLIENTE->oPESSOA->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>ENDERECO</label>
	</div>
	<div class="col-md-9">
		<?=$oCLIENTE->oENDERECO->id?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>