<?php
require_once("classes/autoload.php");
$oController = new ControllerUSUARIO();

$oUSUARIO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes USUARIO <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Login</label>
	</div>
	<div class="col-md-9">
		<?=$oUSUARIO->login?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Senha</label>
	</div>
	<div class="col-md-9">
		<?=$oUSUARIO->senha?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PESSOA</label>
	</div>
	<div class="col-md-9">
		<?=$oUSUARIO->oPESSOA->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PERFIL</label>
	</div>
	<div class="col-md-9">
		<?=$oUSUARIO->oPERFIL->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>