<?php
require_once("classes/autoload.php");
$oController = new ControllerPonto();

$oPonto = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oPonto)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oPonto)) ? ($oController->alterar()) : ($oController->cadastrar());
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
    <div class="container" ng-controller="PontoController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admPonto.php">Ponto</a></li>
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
		<input type="text" class="form-control" id="latitude" name="latitude" value="<?=$oPonto->latitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="longitude">Longitude</label>
		<input type="text" class="form-control" id="longitude" name="longitude" value="<?=$oPonto->longitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="linha_id">Linha_id</label>
		<input type="text" class="form-control" id="linha_id" name="linha_id" value="<?=$oPonto->linha_id?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="codigoAndroid">CodigoAndroid</label>
		<input type="text" class="form-control" id="codigoAndroid" name="codigoAndroid" value="<?=$oPonto->codigoAndroid?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admPonto.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Ponto" />
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