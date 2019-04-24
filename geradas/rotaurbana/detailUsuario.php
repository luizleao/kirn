<?php
require_once("classes/autoload.php");
$oController = new ControllerUsuario();

$oUsuario = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Usuario <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Email</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->email?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Login</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->login?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Roles</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->roles?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Senha</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->senha?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Tos</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->tos?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Numlogins</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->numlogins?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Numrotasvisu</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->numrotasvisu?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Paradascriadas</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->paradascriadas?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Paradaseditadas</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->paradaseditadas?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Rotascriadas</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->rotascriadas?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Rotaseditadas</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->rotaseditadas?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Totalpontos</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->totalpontos?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nivel</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->nivel?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Insig1</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->insig1?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Insig2</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->insig2?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Insig3</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->insig3?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Insig4</label>
	</div>
	<div class="col-md-9">
		<?=$oUsuario->insig4?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>