<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdEdicaoParada();

$oBgdEdicaoParada = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oBgdEdicaoParada)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oBgdEdicaoParada)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerBgdCidade = new ControllerBgdCidade();$aBgdCidade = $oControllerBgdCidade->getAll([], []);
$oControllerBgdCidade = new ControllerBgdCidade();$aBgdCidade = $oControllerBgdCidade->getAll([], []);
$oControllerBgdParada = new ControllerBgdParada();$aBgdParada = $oControllerBgdParada->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="BgdEdicaoParadaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admBgdEdicaoParada.php">BgdEdicaoParada</a></li>
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
		<label for="commentsParada">CommentsParada</label>
		<input type="text" class="form-control" id="commentsParada" name="commentsParada" value="<?=$oBgdEdicaoParada->commentsParada?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="data_captura">Data_captura</label>
	    <?php $oController->componenteCalendario('data_captura', Util::formataDataHoraBancoForm($oBgdEdicaoParada->data_captura), NULL, true)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="titleParada">TitleParada</label>
		<input type="text" class="form-control" id="titleParada" name="titleParada" value="<?=$oBgdEdicaoParada->titleParada?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="bgd_cidade">BgdCidade</label>
		<select name="bgd_cidade" id="bgd_cidade" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aBgdCidade as $oBgdCidade){
		?>
			<option value="<?=$oBgdCidade->bgd_cidade?>"<?=($oBgdCidade->bgd_cidade == $oBgdEdicaoParada->oBgdCidade->id) ? " selected" : ""?>><?=$oBgdCidade->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="fk_bgd_cidade_prox_usuario">BgdCidade</label>
		<select name="fk_bgd_cidade_prox_usuario" id="fk_bgd_cidade_prox_usuario" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aBgdCidade as $oBgdCidade){
		?>
			<option value="<?=$oBgdCidade->fk_bgd_cidade_prox_usuario?>"<?=($oBgdCidade->fk_bgd_cidade_prox_usuario == $oBgdEdicaoParada->oBgdCidade->id) ? " selected" : ""?>><?=$oBgdCidade->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="fk_bgd_parada">BgdParada</label>
		<select name="fk_bgd_parada" id="fk_bgd_parada" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aBgdParada as $oBgdParada){
		?>
			<option value="<?=$oBgdParada->fk_bgd_parada?>"<?=($oBgdParada->fk_bgd_parada == $oBgdEdicaoParada->oBgdParada->id) ? " selected" : ""?>><?=$oBgdParada->id?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="lat_proxma_usuario">Lat_proxma_usuario</label>
		<input type="text" class="form-control" id="lat_proxma_usuario" name="lat_proxma_usuario" value="<?=$oBgdEdicaoParada->lat_proxma_usuario?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="lng_proxma_usuario">Lng_proxma_usuario</label>
		<input type="text" class="form-control" id="lng_proxma_usuario" name="lng_proxma_usuario" value="<?=$oBgdEdicaoParada->lng_proxma_usuario?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="fonte">Fonte</label>
		<input type="text" class="form-control" id="fonte" name="fonte" value="<?=$oBgdEdicaoParada->fonte?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admBgdEdicaoParada.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="BgdEdicaoParada" />
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