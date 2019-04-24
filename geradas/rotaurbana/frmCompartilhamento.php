<?php
require_once("classes/autoload.php");
$oController = new ControllerCompartilhamento();

$oCompartilhamento = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oCompartilhamento)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oCompartilhamento)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerIndicador = new ControllerIndicador();$aIndicador = $oControllerIndicador->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="CompartilhamentoController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admCompartilhamento.php">Compartilhamento</a></li>
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
		<label for="cont">Cont</label>
		<input type="text" class="form-control" id="cont" name="cont" value="<?=$oCompartilhamento->cont?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="id">Indicador</label>
		<select name="id" id="id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aIndicador as $oIndicador){
		?>
			<option value="<?=$oIndicador->id?>"<?=($oIndicador->id == $oCompartilhamento->oIndicador->id) ? " selected" : ""?>><?=$oIndicador->id?></option>
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
                        <a class="btn btn-default" href="admCompartilhamento.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Compartilhamento" />
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