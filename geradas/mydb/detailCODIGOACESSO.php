<?php
require_once("classes/autoload.php");
$oController = new ControllerCODIGOACESSO();

$oCODIGOACESSO = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes CODIGOACESSO <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Codigo</label>
	</div>
	<div class="col-md-9">
		<?=$oCODIGOACESSO->codigo?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PESSOA</label>
	</div>
	<div class="col-md-9">
		<?=$oCODIGOACESSO->oPESSOA->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>