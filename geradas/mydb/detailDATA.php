<?php
require_once("classes/autoload.php");
$oController = new ControllerDATA();

$oDATA = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes DATA <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Data_inicio</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataBancoForm($oDATA->data_inicio)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Data_fim</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataBancoForm($oDATA->data_fim)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>PERFILACESSO</label>
	</div>
	<div class="col-md-9">
		<?=$oDATA->oPERFILACESSO->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>