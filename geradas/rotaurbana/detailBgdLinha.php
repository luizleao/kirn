<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdLinha();

$oBgdLinha = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes BgdLinha <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdLinha->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Codigo</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdLinha->codigo?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Comentario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdLinha->comentario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdLinha->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>