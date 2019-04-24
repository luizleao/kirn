<?php
require_once("classes/autoload.php");
$oController = new ControllerConsultanatelainicial();

$oConsultanatelainicial = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Consultanatelainicial <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Cont</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultanatelainicial->cont?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Indicador</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultanatelainicial->oIndicador->id?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>