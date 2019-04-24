<?php
require_once("classes/autoload.php");
$oController = new ControllerSicasLotacao();

$oSicasLotacao = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes SicasLotacao <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="span3">
		<label>Cd_lotacao</label>
	</div>
	<div class="span9">
		<?=$oSicasLotacao->cd_lotacao?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>