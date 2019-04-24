<?php
require_once("classes/autoload.php");
$oController = new ControllerPrestador();

$oPrestador = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Prestador <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="span3">
		<label>Id</label>
	</div>
	<div class="span9">
		<?=$oPrestador->idPrestador?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>NaturezaContratual</label>
	</div>
	<div class="span9">
		<?=$oPrestador->oNaturezaContratual->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Nome</label>
	</div>
	<div class="span9">
		<?=$oPrestador->nome?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>NumeroContrato</label>
	</div>
	<div class="span9">
		<?=$oPrestador->numeroContrato?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>NomePreposto</label>
	</div>
	<div class="span9">
		<?=$oPrestador->nomePreposto?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>ContatoPreposto</label>
	</div>
	<div class="span9">
		<?=$oPrestador->contatoPreposto?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Usuario</label>
	</div>
	<div class="span9">
		<?=$oPrestador->usuario?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Senha</label>
	</div>
	<div class="span9">
		<?=$oPrestador->senha?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Email</label>
	</div>
	<div class="span9">
		<?=$oPrestador->email?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Status</label>
	</div>
	<div class="span9">
		<?=$oPrestador->status?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>