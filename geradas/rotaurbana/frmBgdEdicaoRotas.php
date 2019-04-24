<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdEdicaoRotas();

$oBgdEdicaoRotas = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oBgdEdicaoRotas)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oBgdEdicaoRotas)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerBgdCidade = new ControllerBgdCidade();$aBgdCidade = $oControllerBgdCidade->getAll([], []);
$oControllerBgdCidade = new ControllerBgdCidade();$aBgdCidade = $oControllerBgdCidade->getAll([], []);
$oControllerBgdLinha = new ControllerBgdLinha();$aBgdLinha = $oControllerBgdLinha->getAll([], []);
$oControllerBgdUsuario = new ControllerBgdUsuario();$aBgdUsuario = $oControllerBgdUsuario->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="BgdEdicaoRotasController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admBgdEdicaoRotas.php">BgdEdicaoRotas</a></li>
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
		<label for="codigoLinha">CodigoLinha</label>
		<input type="text" class="form-control" id="codigoLinha" name="codigoLinha" value="<?=$oBgdEdicaoRotas->codigoLinha?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="comentarioLinha">ComentarioLinha</label>
		<input type="text" class="form-control" id="comentarioLinha" name="comentarioLinha" value="<?=$oBgdEdicaoRotas->comentarioLinha?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="data_captura">Data_captura</label>
	    <?php $oController->componenteCalendario('data_captura', Util::formataDataHoraBancoForm($oBgdEdicaoRotas->data_captura), NULL, true)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="nomeLinhas">NomeLinhas</label>
		<input type="text" class="form-control" id="nomeLinhas" name="nomeLinhas" value="<?=$oBgdEdicaoRotas->nomeLinhas?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="fk_bgd_cidade">BgdCidade</label>
		<select name="fk_bgd_cidade" id="fk_bgd_cidade" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aBgdCidade as $oBgdCidade){
		?>
			<option value="<?=$oBgdCidade->fk_bgd_cidade?>"<?=($oBgdCidade->fk_bgd_cidade == $oBgdEdicaoRotas->oBgdCidade->id) ? " selected" : ""?>><?=$oBgdCidade->nome?></option>
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
			<option value="<?=$oBgdCidade->fk_bgd_cidade_prox_usuario?>"<?=($oBgdCidade->fk_bgd_cidade_prox_usuario == $oBgdEdicaoRotas->oBgdCidade->id) ? " selected" : ""?>><?=$oBgdCidade->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="fk_bgd_linha">BgdLinha</label>
		<select name="fk_bgd_linha" id="fk_bgd_linha" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aBgdLinha as $oBgdLinha){
		?>
			<option value="<?=$oBgdLinha->fk_bgd_linha?>"<?=($oBgdLinha->fk_bgd_linha == $oBgdEdicaoRotas->oBgdLinha->id) ? " selected" : ""?>><?=$oBgdLinha->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="fk_bgd_usuario">BgdUsuario</label>
		<select name="fk_bgd_usuario" id="fk_bgd_usuario" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aBgdUsuario as $oBgdUsuario){
		?>
			<option value="<?=$oBgdUsuario->fk_bgd_usuario?>"<?=($oBgdUsuario->fk_bgd_usuario == $oBgdEdicaoRotas->oBgdUsuario->id) ? " selected" : ""?>><?=$oBgdUsuario->email?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="lat_proxma_usuario">Lat_proxma_usuario</label>
		<input type="text" class="form-control" id="lat_proxma_usuario" name="lat_proxma_usuario" value="<?=$oBgdEdicaoRotas->lat_proxma_usuario?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="lng_proxma_usuario">Lng_proxma_usuario</label>
		<input type="text" class="form-control" id="lng_proxma_usuario" name="lng_proxma_usuario" value="<?=$oBgdEdicaoRotas->lng_proxma_usuario?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="fonte">Fonte</label>
		<input type="text" class="form-control" id="fonte" name="fonte" value="<?=$oBgdEdicaoRotas->fonte?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admBgdEdicaoRotas.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="BgdEdicaoRotas" />
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