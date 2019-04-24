<?php
require_once("classes/autoload.php");
$oController = new ControllerPais();

$oPais = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Pais <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oPais->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oPais->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Sigla</label>
	</div>
	<div class="col-md-9">
		<?=$oPais->sigla?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>