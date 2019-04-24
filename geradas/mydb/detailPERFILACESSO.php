<?php
require_once("classes/autoload.php");
$oController = new ControllerPERFILACESSO();

$oPERFILACESSO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes PERFILACESSO <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oPERFILACESSO->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oPERFILACESSO->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Se_semana</label>
	</div>
	<div class="col-md-9">
		<?=$oPERFILACESSO->se_semana?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>