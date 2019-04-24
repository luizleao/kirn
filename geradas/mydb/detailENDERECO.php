<?php
require_once("classes/autoload.php");
$oController = new ControllerENDERECO();

$oENDERECO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes ENDERECO <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oENDERECO->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Rua</label>
	</div>
	<div class="col-md-9">
		<?=$oENDERECO->rua?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Bairro</label>
	</div>
	<div class="col-md-9">
		<?=$oENDERECO->bairro?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Cep</label>
	</div>
	<div class="col-md-9">
		<?=$oENDERECO->cep?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Numero</label>
	</div>
	<div class="col-md-9">
		<?=$oENDERECO->numero?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Complemento</label>
	</div>
	<div class="col-md-9">
		<?=$oENDERECO->complemento?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>CIDADE</label>
	</div>
	<div class="col-md-9">
		<?=$oENDERECO->oCIDADE->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>