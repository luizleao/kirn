<?php
require_once("classes/autoload.php");
$oController = new ControllerFATURA();

$oFATURA = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes FATURA <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Valor</label>
	</div>
	<div class="col-md-9">
		<?=$oFATURA->valor?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Vencimento</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataBancoForm($oFATURA->vencimento)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Pagamento</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataBancoForm($oFATURA->pagamento)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>CLIENTE</label>
	</div>
	<div class="col-md-9">
		<?=$oFATURA->oCLIENTE->id?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>