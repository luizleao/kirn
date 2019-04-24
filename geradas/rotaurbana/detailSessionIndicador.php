<?php
require_once("classes/autoload.php");
$oController = new ControllerSessionIndicador();

$oSessionIndicador = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes SessionIndicador <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Session</label>
	</div>
	<div class="col-md-9">
		<?=$oSessionIndicador->oSession->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Indicadores_id</label>
	</div>
	<div class="col-md-9">
		<?=$oSessionIndicador->indicadores_id?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>