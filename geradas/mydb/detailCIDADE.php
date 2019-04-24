<?php
require_once("classes/autoload.php");
$oController = new ControllerCIDADE();

$oCIDADE = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes CIDADE <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oCIDADE->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oCIDADE->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>ESTADO</label>
	</div>
	<div class="col-md-9">
		<?=$oCIDADE->oESTADO->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>