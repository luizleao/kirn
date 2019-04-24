<?php
require_once("classes/autoload.php");
$oController = new ControllerNaturezaContratual();

$oNaturezaContratual = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes NaturezaContratual <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="span3">
		<label>Id</label>
	</div>
	<div class="span9">
		<?=$oNaturezaContratual->idNaturezaContratual?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Descricao</label>
	</div>
	<div class="span9">
		<?=$oNaturezaContratual->descricao?>
	</div>
</div>
<div class="row">
	<div class="span3">
		<label>Status</label>
	</div>
	<div class="span9">
		<?=$oNaturezaContratual->status?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>