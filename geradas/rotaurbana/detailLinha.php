<?php
require_once("classes/autoload.php");
$oController = new ControllerLinha();

$oLinha = $oController->get($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes Linha <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		<div class="row">
	<div class="col-md-3">
		<label>Id</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->id?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Codigo</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->codigo?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>EmAvaliacao</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->emAvaliacao?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Nome</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Usuario</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->oUsuario->email?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>SincronizacaoCodigo</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->sincronizacaoCodigo?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Tipo</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->tipo?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Comentario</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->comentario?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Completa</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->completa?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>FaltaCadastrarPontosPesquisa</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->faltaCadastrarPontosPesquisa?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Url</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->url?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Cidade</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->oCidade->nome?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>TipoDeRota</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->tipoDeRota?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>ItinerarioTotalEncoding</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->itinerarioTotalEncoding?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>LastUpdate</label>
	</div>
	<div class="col-md-9">
		<?=Util::formataDataHoraBancoForm($oLinha->lastUpdate)?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Semob</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->semob?>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<label>Linha</label>
	</div>
	<div class="col-md-9">
		<?=$oLinha->oLinha->nome?>
	</div>
</div>
		</fieldset>
    </div>
</body>
</html>