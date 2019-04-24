<?php
require_once("classes/autoload.php");
$oController = new ControllerConsultasnatelavisualizarrotaandroid();

$oConsultasnatelavisualizarrotaandroid = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oConsultasnatelavisualizarrotaandroid)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oConsultasnatelavisualizarrotaandroid)) ? ($oController->alterar()) : ($oController->cadastrar());
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
    <div class="container" ng-controller="ConsultasnatelavisualizarrotaandroidController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admConsultasnatelavisualizarrotaandroid.php">Consultasnatelavisualizarrotaandroid</a></li>
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
		<label for="contador">Contador</label>
		<input type="text" class="form-control" id="contador" name="contador" value="<?=$oConsultasnatelavisualizarrotaandroid->contador?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="idAndroid">IdAndroid</label>
		<input type="text" class="form-control" id="idAndroid" name="idAndroid" value="<?=$oConsultasnatelavisualizarrotaandroid->idAndroid?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admConsultasnatelavisualizarrotaandroid.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Consultasnatelavisualizarrotaandroid" />
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