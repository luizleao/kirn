<?php
require_once("classes/autoload.php");
$oController = new ControllerTicket();

$oTicket = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Ticket <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="span3">
		<label>Id</label>
	</div>
	<div class="span9">
		<?=$oTicket->idTicket?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Servico</label>
	</div>
	<div class="span9">
		<?=$oTicket->oServico->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Cd_servidor_solicitante</label>
	</div>
	<div class="span9">
		<?=$oTicket->cd_servidor_solicitante?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Cd_servidor_recebimento</label>
	</div>
	<div class="span9">
		<?=$oTicket->cd_servidor_recebimento?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Numero</label>
	</div>
	<div class="span9">
		<?=$oTicket->numero?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Descricao</label>
	</div>
	<div class="span9">
		<?=$oTicket->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>DataHoraAbertura</label>
	</div>
	<div class="span9">
		<?=Util::formataDataHoraBancoForm($oTicket->dataHoraAbertura)?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>FlagAprovado</label>
	</div>
	<div class="span9">
		<?=$oTicket->flagAprovado?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>FlagAtendido</label>
	</div>
	<div class="span9">
		<?=$oTicket->flagAtendido?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>FlagExecutado</label>
	</div>
	<div class="span9">
		<?=$oTicket->flagExecutado?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Status</label>
	</div>
	<div class="span9">
		<?=$oTicket->status?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>