<?php
require_once("classes/autoload.php");
$oController = new ControllerLogVoicer();

$oLogVoicer = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oLogVoicer)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oLogVoicer)) ? ($oController->alterar()) : ($oController->cadastrar());
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
    <div class="container" ng-controller="LogVoicerController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admLogVoicer.php">LogVoicer</a></li>
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
		<label for="compreendido">Compreendido</label>
		<input type="text" class="form-control" id="compreendido" name="compreendido" value="<?=$oLogVoicer->compreendido?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="idUsuario">IdUsuario</label>
		<input type="text" class="form-control" id="idUsuario" name="idUsuario" value="<?=$oLogVoicer->idUsuario?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="menuAtual">MenuAtual</label>
		<input type="text" class="form-control" id="menuAtual" name="menuAtual" value="<?=$oLogVoicer->menuAtual?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
	    <label for="momento">Momento</label>
	    <?php $oController->componenteCalendario('momento', Util::formataDataHoraBancoForm($oLogVoicer->momento), NULL, true)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="resultado">Resultado</label>
		<input type="text" class="form-control" id="resultado" name="resultado" value="<?=$oLogVoicer->resultado?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admLogVoicer.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="LogVoicer" />
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