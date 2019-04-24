<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdEdicaoParada();

$oBgdEdicaoParada = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes BgdEdicaoParada <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoParada->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>CommentsParada</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoParada->commentsParada?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Data_captura</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataHoraBancoForm($oBgdEdicaoParada->data_captura)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>TitleParada</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoParada->titleParada?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoParada->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoParada->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdParada</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoParada->oBgdParada->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lat_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoParada->lat_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lng_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoParada->lng_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Fonte</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdEdicaoParada->fonte?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>