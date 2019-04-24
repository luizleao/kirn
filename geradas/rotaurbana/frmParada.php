<?php
require_once("classes/autoload.php");
$oController = new ControllerParada();

$oParada = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oParada)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oParada)) ? ($oController->alterar()) : ($oController->cadastrar());
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
    <div class="container" ng-controller="ParadaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admParada.php">Parada</a></li>
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
		<input type="text" class="form-control" id="latitude" name="latitude" value="<?=$oParada->latitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="longitude">Longitude</label>
		<input type="text" class="form-control" id="longitude" name="longitude" value="<?=$oParada->longitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="status">Status</label>
		<input type="text" class="form-control" id="status" name="status" value="<?=$oParada->status?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="comments">Comments</label>
		<input type="text" class="form-control" id="comments" name="comments" value="<?=$oParada->comments?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="title">Title</label>
		<input type="text" class="form-control" id="title" name="title" value="<?=$oParada->title?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="tipoDeRotaDaParada">TipoDeRotaDaParada</label>
		<input type="text" class="form-control" id="tipoDeRotaDaParada" name="tipoDeRotaDaParada" value="<?=$oParada->tipoDeRotaDaParada?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admParada.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Parada" />
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