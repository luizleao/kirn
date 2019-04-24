<?php
require_once("classes/autoload.php");
$oController = new ControllerDIA();

$oDIA = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes DIA <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>D</label>
	</div>
	<div class="col-md-9">
		<?=$oDIA->d?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PERFILACESSO</label>
	</div>
	<div class="col-md-9">
		<?=$oDIA->oPERFILACESSO->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>