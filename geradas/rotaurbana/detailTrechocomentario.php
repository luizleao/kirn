<?php
require_once("classes/autoload.php");
$oController = new ControllerTrechocomentario();

$oTrechocomentario = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Trechocomentario <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oTrechocomentario->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Comentario</label>
	</div>
	<div class="col-md-9">
		<?=$oTrechocomentario->comentario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Linha</label>
	</div>
	<div class="col-md-9">
		<?=$oTrechocomentario->oLinha->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>