<?php
require_once("classes/autoload.php");
$oController = new ControllerEstado();

$oEstado = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Estado <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oEstado->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oEstado->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Uf</label>
	</div>
	<div class="col-md-9">
		<?=$oEstado->uf?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Pais</label>
	</div>
	<div class="col-md-9">
		<?=$oEstado->oPais->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>