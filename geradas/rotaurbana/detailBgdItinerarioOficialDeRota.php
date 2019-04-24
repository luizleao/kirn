<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdItinerarioOficialDeRota();

$oBgdItinerarioOficialDeRota = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes BgdItinerarioOficialDeRota <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdItinerarioOficialDeRota->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Data_captura</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataHoraBancoForm($oBgdItinerarioOficialDeRota->data_captura)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdItinerarioOficialDeRota->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdCidade</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdItinerarioOficialDeRota->oBgdCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdLinha</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdItinerarioOficialDeRota->oBgdLinha->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>BgdUsuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdItinerarioOficialDeRota->oBgdUsuario->email?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lat_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdItinerarioOficialDeRota->lat_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Lng_proxma_usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdItinerarioOficialDeRota->lng_proxma_usuario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Fonte</label>
	</div>
	<div class="col-md-9">
		<?=$oBgdItinerarioOficialDeRota->fonte?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>