<?php
require_once("classes/autoload.php");
$oController = new ControllerAcompanhamento();

$oAcompanhamento = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Acompanhamento <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="span3">
		<label>Id</label>
	</div>
	<div class="span9">
		<?=$oAcompanhamento->idAcompanhamento?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Ticket</label>
	</div>
	<div class="span9">
		<?=$oAcompanhamento->oTicket->idTicket?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Descricao</label>
	</div>
	<div class="span9">
		<?=$oAcompanhamento->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>DataHora</label>
	</div>
	<div class="span9">
		<?=Util::formataDataHoraBancoForm($oAcompanhamento->dataHora)?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Usuario</label>
	</div>
	<div class="span9">
		<?=$oAcompanhamento->usuario?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Status</label>
	</div>
	<div class="span9">
		<?=$oAcompanhamento->status?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>