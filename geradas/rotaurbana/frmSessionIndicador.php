<?php
require_once("classes/autoload.php");
$oController = new ControllerSessionIndicador();

$oSessionIndicador = ($_REQUEST['indicadores_id'] == "") ? NULL        : $oController->get($_REQUEST['indicadores_id']);
$label   = (is_null($oSessionIndicador)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oSessionIndicador)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerSession = new ControllerSession();$aSession = $oControllerSession->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="SessionIndicadorController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admSessionIndicador.php">SessionIndicador</a></li>
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
		<label for="session_id">Session</label>
		<select name="session_id" id="session_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aSession as $oSession){
		?>
			<option value="<?=$oSession->session_id?>"<?=($oSession->session_id == $oSessionIndicador->oSession->id) ? " selected" : ""?>><?=$oSession->id?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="session_id">Session</label>
		<select name="session_id" id="session_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aSession as $oSession){
		?>
			<option value="<?=$oSession->session_id?>"<?=($oSession->session_id == $oSessionIndicador->oSession->id) ? " selected" : ""?>><?=$oSession->id?></option>
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
                        <a class="btn btn-default" href="admSessionIndicador.php">Voltar</a>
                        <input name="indicadores_id" type="hidden" id="indicadores_id" value="<?=$_REQUEST['indicadores_id']?>" />
                        <input type="hidden" name="classe" id="classe" value="SessionIndicador" />
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