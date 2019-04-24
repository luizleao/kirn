<?php
require_once("classes/autoload.php");
$oController = new ControllerConsultasnatelavisualizarrotaandroid();

$oConsultasnatelavisualizarrotaandroid = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Consultasnatelavisualizarrotaandroid <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultasnatelavisualizarrotaandroid->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Contador</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultasnatelavisualizarrotaandroid->contador?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>IdAndroid</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultasnatelavisualizarrotaandroid->idAndroid?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>