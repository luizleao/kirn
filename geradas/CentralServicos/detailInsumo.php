<?php
require_once("classes/autoload.php");
$oController = new ControllerInsumo();

$oInsumo = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Insumo <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="span3">
		<label>Id</label>
	</div>
	<div class="span9">
		<?=$oInsumo->idInsumo?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>NaturezaContratual</label>
	</div>
	<div class="span9">
		<?=$oInsumo->oNaturezaContratual->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Descricao</label>
	</div>
	<div class="span9">
		<?=$oInsumo->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Estoque</label>
	</div>
	<div class="span9">
		<?=$oInsumo->estoque?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Valor</label>
	</div>
	<div class="span9">
		<?=$oInsumo->valor?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Status</label>
	</div>
	<div class="span9">
		<?=$oInsumo->status?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>