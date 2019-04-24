<?php
require_once("classes/autoload.php");
$oController = new ControllerPontopesquisa();

$oPontopesquisa = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oPontopesquisa)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oPontopesquisa)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerLinha = new ControllerLinha();$aLinha = $oControllerLinha->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="PontopesquisaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admPontopesquisa.php">Pontopesquisa</a></li>
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
		<input type="text" class="form-control" id="latitude" name="latitude" value="<?=$oPontopesquisa->latitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="longitude">Longitude</label>
		<input type="text" class="form-control" id="longitude" name="longitude" value="<?=$oPontopesquisa->longitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="posicao">Posicao</label>
		<input type="text" class="form-control" id="posicao" name="posicao" value="<?=$oPontopesquisa->posicao?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="tipo">Tipo</label>
		<input type="text" class="form-control" id="tipo" name="tipo" value="<?=$oPontopesquisa->tipo?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="linha_id">Linha</label>
		<select name="linha_id" id="linha_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aLinha as $oLinha){
		?>
			<option value="<?=$oLinha->linha_id?>"<?=($oLinha->linha_id == $oPontopesquisa->oLinha->id) ? " selected" : ""?>><?=$oLinha->nome?></option>
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
                        <a class="btn btn-default" href="admPontopesquisa.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Pontopesquisa" />
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