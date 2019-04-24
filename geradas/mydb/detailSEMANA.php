<?php
require_once("classes/autoload.php");
$oController = new ControllerSEMANA();

$oSEMANA = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes SEMANA <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Dia_semana</label>
	</div>
	<div class="col-md-9">
		<?=$oSEMANA->dia_semana?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PERFILACESSO</label>
	</div>
	<div class="col-md-9">
		<?=$oSEMANA->oPERFILACESSO->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>