<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdDistanciaRotaConsulta();

$oBgdDistanciaRotaConsulta = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oBgdDistanciaRotaConsulta)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oBgdDistanciaRotaConsulta)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerBgdCidade = new ControllerBgdCidade();$aBgdCidade = $oControllerBgdCidade->getAll([], []);
$oControllerBgdLinha = new ControllerBgdLinha();$aBgdLinha = $oControllerBgdLinha->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="BgdDistanciaRotaConsultaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admBgdDistanciaRotaConsulta.php">BgdDistanciaRotaConsulta</a></li>
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
	    <label for="data_captura">Data_captura</label>
	    <?php $oController->componenteCalendario('data_captura', Util::formataDataHoraBancoForm($oBgdDistanciaRotaConsulta->data_captura), NULL, true)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="distancia">Distancia</label>
		<input type="text" class="form-control" id="distancia" name="distancia" value="<?=$oBgdDistanciaRotaConsulta->distancia?>" />
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
			<option value="<?=$oBgdCidade->fk_bgd_cidade?>"<?=($oBgdCidade->fk_bgd_cidade == $oBgdDistanciaRotaConsulta->oBgdCidade->id) ? " selected" : ""?>><?=$oBgdCidade->nome?></option>
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
			<option value="<?=$oBgdLinha->fk_bgd_linha?>"<?=($oBgdLinha->fk_bgd_linha == $oBgdDistanciaRotaConsulta->oBgdLinha->id) ? " selected" : ""?>><?=$oBgdLinha->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="fonte">Fonte</label>
		<input type="text" class="form-control" id="fonte" name="fonte" value="<?=$oBgdDistanciaRotaConsulta->fonte?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admBgdDistanciaRotaConsulta.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="BgdDistanciaRotaConsulta" />
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