<?php
require_once("classes/autoload.php");
$oController = new ControllerConsultanatelavisualizarrota();

$oConsultanatelavisualizarrota = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Consultanatelavisualizarrota <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Cont</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultanatelavisualizarrota->cont?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Indicador</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultanatelavisualizarrota->oIndicador->id?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>