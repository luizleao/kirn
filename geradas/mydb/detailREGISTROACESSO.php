<?php
require_once("classes/autoload.php");
$oController = new ControllerREGISTROACESSO();

$oREGISTROACESSO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes REGISTROACESSO <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oREGISTROACESSO->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Data</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataBancoForm($oREGISTROACESSO->data)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Hora</label>
	</div>
	<div class="col-md-9">
		<?=$oREGISTROACESSO->hora?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Sentido</label>
	</div>
	<div class="col-md-9">
		<?=$oREGISTROACESSO->sentido?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Permissao</label>
	</div>
	<div class="col-md-9">
		<?=$oREGISTROACESSO->permissao?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PESSOA</label>
	</div>
	<div class="col-md-9">
		<?=$oREGISTROACESSO->oPESSOA->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PERFILACESSO</label>
	</div>
	<div class="col-md-9">
		<?=$oREGISTROACESSO->oPERFILACESSO->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>