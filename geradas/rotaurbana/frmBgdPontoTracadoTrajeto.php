<?php
require_once("classes/autoload.php");
$oController = new ControllerBgdPontoTracadoTrajeto();

$oBgdPontoTracadoTrajeto = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oBgdPontoTracadoTrajeto)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oBgdPontoTracadoTrajeto)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerBgdLinha = new ControllerBgdLinha();$aBgdLinha = $oControllerBgdLinha->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="BgdPontoTracadoTrajetoController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admBgdPontoTracadoTrajeto.php">BgdPontoTracadoTrajeto</a></li>
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
		<label for="latitude">Latitude</label>
		<input type="text" class="form-control" id="latitude" name="latitude" value="<?=$oBgdPontoTracadoTrajeto->latitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="longitude">Longitude</label>
		<input type="text" class="form-control" id="longitude" name="longitude" value="<?=$oBgdPontoTracadoTrajeto->longitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="posicao">Posicao</label>
		<input type="text" class="form-control" id="posicao" name="posicao" value="<?=$oBgdPontoTracadoTrajeto->posicao?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="tipo">Tipo</label>
		<input type="text" class="form-control" id="tipo" name="tipo" value="<?=$oBgdPontoTracadoTrajeto->tipo?>" />
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
			<option value="<?=$oBgdLinha->fk_bgd_linha?>"<?=($oBgdLinha->fk_bgd_linha == $oBgdPontoTracadoTrajeto->oBgdLinha->id) ? " selected" : ""?>><?=$oBgdLinha->nome?></option>
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
                        <a class="btn btn-default" href="admBgdPontoTracadoTrajeto.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="BgdPontoTracadoTrajeto" />
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