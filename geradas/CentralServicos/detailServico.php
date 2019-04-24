<?php
require_once("classes/autoload.php");
$oController = new ControllerServico();

$oServico = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Servico <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="span3">
		<label>Id</label>
	</div>
	<div class="span9">
		<?=$oServico->idServico?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Sla</label>
	</div>
	<div class="span9">
		<?=$oServico->oSla->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>TipoServico</label>
	</div>
	<div class="span9">
		<?=$oServico->oTipoServico->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Descricao</label>
	</div>
	<div class="span9">
		<?=$oServico->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Valor</label>
	</div>
	<div class="span9">
		<?=$oServico->valor?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Status</label>
	</div>
	<div class="span9">
		<?=$oServico->status?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>