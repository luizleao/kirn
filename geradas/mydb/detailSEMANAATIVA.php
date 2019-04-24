<?php
require_once("classes/autoload.php");
$oController = new ControllerSEMANAATIVA();

$oSEMANAATIVA = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes SEMANAATIVA <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Semana</label>
	</div>
	<div class="col-md-9">
		<?=$oSEMANAATIVA->semana?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PERFILACESSO</label>
	</div>
	<div class="col-md-9">
		<?=$oSEMANAATIVA->oPERFILACESSO->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>