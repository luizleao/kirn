<?php
require_once("classes/autoload.php");
$oController = new ControllerPatrimonioTicket();

$oPatrimonioTicket = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes PatrimonioTicket <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="span3">
		<label>Id</label>
	</div>
	<div class="span9">
		<?=$oPatrimonioTicket->idPatrimonioTicket?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Ticket</label>
	</div>
	<div class="span9">
		<?=$oPatrimonioTicket->oTicket->idTicket?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Tombamento</label>
	</div>
	<div class="span9">
		<?=$oPatrimonioTicket->tombamento?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Status</label>
	</div>
	<div class="span9">
		<?=$oPatrimonioTicket->status?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>