<?php
require_once("classes/autoload.php");
$oController = new ControllerHORARIO();

$oHORARIO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes HORARIO <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Horario_inicio</label>
	</div>
	<div class="col-md-9">
		<?=$oHORARIO->horario_inicio?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Horario_fim</label>
	</div>
	<div class="col-md-9">
		<?=$oHORARIO->horario_fim?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PERFILACESSO</label>
	</div>
	<div class="col-md-9">
		<?=$oHORARIO->oPERFILACESSO->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>