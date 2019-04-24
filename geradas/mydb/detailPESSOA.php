<?php
require_once("classes/autoload.php");
$oController = new ControllerPESSOA();

$oPESSOA = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes PESSOA <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oPESSOA->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oPESSOA->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Cpf</label>
	</div>
	<div class="col-md-9">
		<?=$oPESSOA->cpf?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nascimento</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataBancoForm($oPESSOA->nascimento)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PERFILACESSO</label>
	</div>
	<div class="col-md-9">
		<?=$oPESSOA->oPERFILACESSO->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>