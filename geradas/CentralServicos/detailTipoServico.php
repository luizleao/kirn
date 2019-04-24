<?php
require_once("classes/autoload.php");
$oController = new ControllerTipoServico();

$oTipoServico = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes TipoServico <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="span3">
		<label>Id</label>
	</div>
	<div class="span9">
		<?=$oTipoServico->idTipoServico?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>NaturezaContratual</label>
	</div>
	<div class="span9">
		<?=$oTipoServico->oNaturezaContratual->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Descricao</label>
	</div>
	<div class="span9">
		<?=$oTipoServico->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Status</label>
	</div>
	<div class="span9">
		<?=$oTipoServico->status?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>