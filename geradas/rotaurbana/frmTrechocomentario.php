<?php
require_once("classes/autoload.php");
$oController = new ControllerTrechocomentario();

$oTrechocomentario = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oTrechocomentario)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oTrechocomentario)) ? ($oController->alterar()) : ($oController->cadastrar());
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
    <div class="container" ng-controller="TrechocomentarioController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admTrechocomentario.php">Trechocomentario</a></li>
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
		<label for="comentario">Comentario</label>
		<input type="text" class="form-control" id="comentario" name="comentario" value="<?=$oTrechocomentario->comentario?>" />
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
			<option value="<?=$oLinha->linha_id?>"<?=($oLinha->linha_id == $oTrechocomentario->oLinha->id) ? " selected" : ""?>><?=$oLinha->nome?></option>
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
                        <a class="btn btn-default" href="admTrechocomentario.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Trechocomentario" />
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