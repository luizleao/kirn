<?php
require_once("classes/autoload.php");
$oController = new ControllerParadaLinha();

$oParadaLinha = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes ParadaLinha <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Paradas_id</label>
	</div>
	<div class="col-md-9">
		<?=$oParadaLinha->paradas_id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Linha_id</label>
	</div>
	<div class="col-md-9">
		<?=$oParadaLinha->linha_id?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>