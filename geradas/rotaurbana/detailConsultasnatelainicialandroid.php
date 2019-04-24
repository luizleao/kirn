<?php
require_once("classes/autoload.php");
$oController = new ControllerConsultasnatelainicialandroid();

$oConsultasnatelainicialandroid = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Consultasnatelainicialandroid <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultasnatelainicialandroid->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Contador</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultasnatelainicialandroid->contador?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>IdAndroid</label>
	</div>
	<div class="col-md-9">
		<?=$oConsultasnatelainicialandroid->idAndroid?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>