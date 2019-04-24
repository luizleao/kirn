<?php
require_once("classes/autoload.php");
$oController = new ControllerParadaLinha();

$oParadaLinha = ($_REQUEST[''] == "") ? NULL        : $oController->get($_REQUEST['']);
$label   = (is_null($oParadaLinha)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oParadaLinha)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}


?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="ParadaLinhaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admParadaLinha.php">ParadaLinha</a></li>
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
		<label for="paradas_id">Paradas_id</label>
		<input type="text" class="form-control" id="paradas_id" name="paradas_id" value="<?=$oParadaLinha->paradas_id?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="linha_id">Linha_id</label>
		<input type="text" class="form-control" id="linha_id" name="linha_id" value="<?=$oParadaLinha->linha_id?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admParadaLinha.php">Voltar</a>
                        
                        <input type="hidden" name="classe" id="classe" value="ParadaLinha" />
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