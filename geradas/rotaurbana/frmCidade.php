<?php
require_once("classes/autoload.php");
$oController = new ControllerCidade();

$oCidade = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oCidade)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oCidade)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerEstado = new ControllerEstado();$aEstado = $oControllerEstado->getAll([], []);
$oControllerCidade = new ControllerCidade();$aCidade = $oControllerCidade->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="CidadeController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admCidade.php">Cidade</a></li>
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
		<input type="text" class="form-control" id="latitude" name="latitude" value="<?=$oCidade->latitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="longitude">Longitude</label>
		<input type="text" class="form-control" id="longitude" name="longitude" value="<?=$oCidade->longitude?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="nome">Nome</label>
		<input type="text" class="form-control" id="nome" name="nome" value="<?=$oCidade->nome?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="estado_id">Estado</label>
		<select name="estado_id" id="estado_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aEstado as $oEstado){
		?>
			<option value="<?=$oEstado->estado_id?>"<?=($oEstado->estado_id == $oCidade->oEstado->id) ? " selected" : ""?>><?=$oEstado->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="belongsTo_id">Cidade</label>
		<select name="belongsTo_id" id="belongsTo_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aCidade as $oCidade){
		?>
			<option value="<?=$oCidade->belongsTo_id?>"<?=($oCidade->belongsTo_id == $oCidade->oCidade->id) ? " selected" : ""?>><?=$oCidade->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="sameAs">SameAs</label>
		<input type="text" class="form-control" id="sameAs" name="sameAs" value="<?=$oCidade->sameAs?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="latitudeDouble">LatitudeDouble</label>
		<input type="text" class="form-control" id="latitudeDouble" name="latitudeDouble" value="<?=$oCidade->latitudeDouble?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="longitudeDouble">LongitudeDouble</label>
		<input type="text" class="form-control" id="longitudeDouble" name="longitudeDouble" value="<?=$oCidade->longitudeDouble?>" />
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admCidade.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="Cidade" />
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