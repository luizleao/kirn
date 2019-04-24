<?php
require_once("classes/autoload.php");
$oController = new ControllerLinha();

$oLinha = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oLinha)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oLinha)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerUsuario = new ControllerUsuario();$aUsuario = $oControllerUsuario->getAll([], []);
$oControllerCidade = new ControllerCidade();$aCidade = $oControllerCidade->getAll([], []);
$oControllerLinha = new ControllerLinha();$aLinha = $oControllerLinha->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="LinhaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admLinha.php">Linha</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?=$label?></li>
			</ol>
		</nav>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                
<div class="col-md-4">
	<div class="form-group">
		<label for="codigo">Codigo</label>
		<input type="text" class="form-control" id="codigo" name="codigo" value="<?=$oLinha->codigo?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="emAvaliacao">EmAvaliacao</label>
		<input type="text" class="form-control" id="emAvaliacao" name="emAvaliacao" value="<?=$oLinha->emAvaliacao?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="nome">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" value="<?=$oLinha->nome?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="usuario_id">Usuario</label>
		<select name="usuario_id" id="usuario_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aUsuario as $oUsuario){
		?>
			<option value="<?=$oUsuario->usuario_id?>"<?=($oUsuario->usuario_id == $oLinha->oUsuario->id) ? " selected" : ""?>><?=$oUsuario->email?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="sincronizacaoCodigo">SincronizacaoCodigo</label>
		<input type="text" class="form-control" id="sincronizacaoCodigo" name="sincronizacaoCodigo" value="<?=$oLinha->sincronizacaoCodigo?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="tipo">Tipo</label>
		<input type="text" class="form-control" id="tipo" name="tipo" value="<?=$oLinha->tipo?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="comentario">Comentario</label>
		<input type="text" class="form-control" id="comentario" name="comentario" value="<?=$oLinha->comentario?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="completa">Completa</label>
		<input type="text" class="form-control" id="completa" name="completa" value="<?=$oLinha->completa?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="faltaCadastrarPontosPesquisa">FaltaCadastrarPontosPesquisa</label>
		<input type="text" class="form-control" id="faltaCadastrarPontosPesquisa" name="faltaCadastrarPontosPesquisa" value="<?=$oLinha->faltaCadastrarPontosPesquisa?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="url">url</label>
	    <div class="input-group">
	        <div class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></div>
	        <input type="text" class="form-control" name="url" id="url" value="<?=$oLinha->url?>" />
	    </div>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="cidade_id">Cidade</label>
		<select name="cidade_id" id="cidade_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aCidade as $oCidade){
		?>
			<option value="<?=$oCidade->cidade_id?>"<?=($oCidade->cidade_id == $oLinha->oCidade->id) ? " selected" : ""?>><?=$oCidade->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="tipoDeRota">TipoDeRota</label>
		<input type="text" class="form-control" id="tipoDeRota" name="tipoDeRota" value="<?=$oLinha->tipoDeRota?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="itinerarioTotalEncoding">ItinerarioTotalEncoding</label>
		<input type="text" class="form-control" id="itinerarioTotalEncoding" name="itinerarioTotalEncoding" value="<?=$oLinha->itinerarioTotalEncoding?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="lastUpdate">LastUpdate</label>
	    <?php $oController->componenteCalendario('lastUpdate', Util::formataDataHoraBancoForm($oLinha->lastUpdate), NULL, true)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="semob">Semob</label>
		<input type="text" class="form-control" id="semob" name="semob" value="<?=$oLinha->semob?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="root">Linha</label>
		<select name="root" id="root" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aLinha as $oLinha){
		?>
			<option value="<?=$oLinha->root?>"<?=($oLinha->root == $oLinha->oLinha->id) ? " selected" : ""?>><?=$oLinha->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admLinha.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Linha" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>