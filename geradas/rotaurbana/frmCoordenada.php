<?php
require_once("classes/autoload.php");
$oController = new ControllerCoordenada();

$oCoordenada = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oCoordenada)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oCoordenada)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerTrechocomentario = new ControllerTrechocomentario();$aTrechocomentario = $oControllerTrechocomentario->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="CoordenadaController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admCoordenada.php">Coordenada</a></li>
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
		<input type="text" class="form-control" id="latitude" name="latitude" value="<?=$oCoordenada->latitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="longitude">Longitude</label>
		<input type="text" class="form-control" id="longitude" name="longitude" value="<?=$oCoordenada->longitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="trechoComentario_id">Trechocomentario</label>
		<select name="trechoComentario_id" id="trechoComentario_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aTrechocomentario as $oTrechocomentario){
		?>
			<option value="<?=$oTrechocomentario->trechoComentario_id?>"<?=($oTrechocomentario->trechoComentario_id == $oCoordenada->oTrechocomentario->id) ? " selected" : ""?>><?=$oTrechocomentario->id?></option>
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
                        <a class="btn btn-default" href="admCoordenada.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Coordenada" />
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